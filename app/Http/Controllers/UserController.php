<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Imports\UsersImport;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function leave(Request $request)
    {
        if (empty($request->status) || empty($request->startDate) || empty($request->endDate)) {
            session()->flash('error', "Tidak Boleh Ada Data Yang Kosong");
            return redirect()->back();
        }
        try {
            $startDate = Carbon::parse($request->startDate);
            $endDate = Carbon::parse($request->endDate);

            $user = User::findOrFail($request->userId);

            $selisihHari = $startDate->diffInDays($endDate);
            $selisihHari = $selisihHari;
            $type = ucwords($request->status);
            for ($i = 0; $i <= $selisihHari; $i++) {
                Attendance::create([
                    'type' => $type,
                    'status' => Attendance::APPROVE,
                    'user_id' => $request->userId,
                    'settings_id' => null,
                    'date' => $startDate->copy()->addDays($i)->format('Y-m-d')
                ]);
            }
            session()->flash('success', "Pengajuan {$type} {$user->name} Diterima");
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('error', "Pengajuan Cuti Gagal Silahkan Coba lagi");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        if (empty($request->file('file'))) {
            session()->flash('error', "File Dokument Tidak Boleh Kosong");
            return redirect()->back();
        }

        try {
            $file = $request->file('file');
            Excel::import(new UsersImport, Storage::put('excelUploads', $file));
            session()->flash('success', "Import User Berhasil");
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', "Gagal Import User, Silahkan Cek File Anda");
            return redirect()->back();
        }
    }

    public function download(Request $request)
    {
        if (empty($request->month)) {
            session()->flash('error', "Silahkan Isi Data Tanggal Terlebih dahulu");
            return redirect()->back();
        }

        try {
            $yearMonth = explode('-', $request->month);
            $year = $yearMonth[0];
            $month = $yearMonth[1];
            $attendances = Attendance::join('users', 'users.id', 'attendances.user_id')
                ->select('attendances.type', 'attendances.check_in', 'attendances.check_out', 'attendances.date', 'users.name', 'users.rank', 'users.nip')
                ->where('users.is_admin', 0)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->groupBy('attendances.id')
                ->get();

            if (empty($attendances)) {
                session()->flash('error', "Data Pada Bulan Yang Dipilih Tidak Tersedia");
                return redirect()->back();
            }
            $datas = $this->processData($attendances, $month, $year);

            return Excel::download(new AttendanceExport($datas), $request->month . '.xlsx');
        } catch (\Throwable $th) {
            session()->flash('error', "Perhatikan Data Yang Dipilih, Silahkan Coba Lagi");
            return redirect()->back();
        }
    }


    function processData($attendances, $month, $year)
    {
        // Urutkan data berdasarkan tanggal
        $attendances = $attendances->sortBy(function ($attendance) {
            return strtotime($attendance->date);
        });

        $groupedData = [];

        // Kelompokkan data berdasarkan nama pengguna
        foreach ($attendances as $attendance) {
            $key = $attendance->name;
            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [];
            }
            $groupedData[$key][$attendance->date] = [
                'type' => $attendance->type,
                'check_in' => $attendance->check_in ?: null,
                'check_out' => $attendance->check_out ?: null,
                'rank' => $attendance->rank,
            ];
        }

        $result = [];
        // Mendapatkan jumlah hari dalam bulan tertentu
        $totalDays = Carbon::createFromDate($year, $month)->daysInMonth;

        // Isi tanggal yang hilang dan susun hasilnya
        foreach ($groupedData as $name => $dates) {
            $attendanceDetails = [];
            // Periksa setiap hari dalam bulan tersebut
            for ($day = 1; $day <= $totalDays; $day++) {
                $date = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                if (!isset($dates[$date])) {
                    // Tambahkan data dengan type 'tanpa keterangan' jika tanggal tersebut tidak ada
                    $attendanceDetails[] = [
                        'date' => $date,
                        'type' => 'tanpa keterangan',
                        'check_in' => null,
                        'check_out' => null,
                        'rank' => '',
                    ];
                } else {
                    // Masukkan data yang sudah ada
                    $attendanceDetails[] = array_merge(['date' => $date], $dates[$date]);
                }
            }

            // Tambahkan data ke hasil akhir
            $result[] = [
                'name' => $name,
                'attendances' => $attendanceDetails,
            ];
        }

        return $result;
    }
}
