<?php

namespace App\Http\Controllers;

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

            for ($i = 0; $i <= $selisihHari; $i++) {
                Attendance::create([
                    'type' => ucwords($request->status),
                    'status' => Attendance::APPROVE,
                    'user_id' => $request->userId,
                    'settings_id' => null,
                    'date' => $startDate->copy()->addDays($i)->format('Y-m-d')
                ]);
            }
            session()->flash('success', "Pengajuan Cuti {$user->name} Diterima");
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
}
