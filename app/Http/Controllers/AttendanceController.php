<?php

namespace App\Http\Controllers;

use App\Helpers\GeoHelper;
use App\Models\Attendance;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'typeAttendance' => 'required',
            'document' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif|max:10240',
            'imageSubmit' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        try {
            $userId = Auth::user()->id;
            Carbon::setLocale('id');
            $dayOfWeek = Carbon::now()->translatedFormat('l');
            $setting = Setting::where('day', strtolower($dayOfWeek))->first();

            if ($request->typeAttendance == 'Piket' || $request->typeAttendance == 'Hadir') {
                $calculatingDistance = $this->calculatingDistance($request);
            } elseif ($request->typeAttendance == 'Tugas'  and !isset($request->document)) {
                session()->flash('error', ' Surat Tugas Tidak Boleh Kosong');
                return redirect()->back();
            }

            $time =  date('H:i');
            $date = date('Y-m-d');

            if (empty($setting)) {
                session()->flash('error', 'Pengturan Jam kerja belum dibuat untuk hari ' . $dayOfWeek);
                return redirect()->back();
            }

            $checkAttendance =  Attendance::where('date', $date)->where('user_id', $userId)->first();
            $data = [
                'type' =>  $request->typeAttendance,
                'check_in' => $time,
                'check_out' => '',
                'user_id' => $userId,
                'date' =>  $date
            ];
            if ($checkAttendance) {
                // check_in
                $setting_time_gohome = $setting->time_gohome;
                $setting_time = Carbon::createFromFormat('H:i', $setting_time_gohome);
                $current_time_obj = Carbon::createFromFormat('H:i', $time);
                if ($current_time_obj->lessThan($setting_time)) {
                    session()->flash('error', 'Anda Belum bisa pulang pada pukul ' . $time . ' silahkan kembali lagi pada pukul ' . $setting->time_gohome);
                    return redirect()->back();
                }
                $this->handelCheckOut($checkAttendance, $time, $request);
            } else {
                // datang
                $setting_time_arrival = $setting->time_arrival;
                $setting_time = Carbon::createFromFormat('H:i', $setting_time_arrival);
                $current_time_obj = Carbon::createFromFormat('H:i', $time);

                if ($setting_time->lessThan($current_time_obj)) {
                    session()->flash('error', 'Anda Terlambat');
                    return redirect()->back();
                }
                $this->handelCheckIn($setting, $data, $request);
            }
            DB::commit();
            session()->flash('success', 'Anda Berhasil Mengisi Daftar Hadir');

            return redirect()->route('absen.user.daftar');
        } catch (InvalidFormatException $e) {
            session()->flash('error', 'Lokasi Anda Tidak Sesuai');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack($e);
            Log::error();
            session()->flash('error', 'Silahkan coba lagi ');
            return redirect()->back();
        }
    }

    private function handelCheckIn($setting, $data, $request)
    {
        $document = '';
        $image = '';
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
            $document = $documentPath;
        }

        if ($request->has('imageSubmit')) {
            $imageData = $request->input('imageSubmit');
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);
            $extension = explode('/', $type)[1];
            $fileName = 'attendance/' . uniqid() . '.' . $extension;
            Storage::disk('public')->put($fileName, $imageData);
            $image = $fileName;
        }

        Attendance::create([
            'type' => $data['type'],
            'file_assignment' =>  $document ?? null,
            'foto' => $image,
            'check_in' => $data['check_in'],
            'status' => Attendance::APPROVE,
            'user_id' => $data['user_id'],
            'settings_id' => $setting->id,
            'date' => $data['date']
        ]);
    }

    private function handelCheckOut($attendance, $time, $request)
    {
        $document = '';
        $image = '';
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
            $document = $documentPath;
        }

        if ($request->has('imageSubmit')) {
            $imageData = $request->input('imageSubmit');
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);
            $extension = explode('/', $type)[1];
            $fileName = 'attendance/' . uniqid() . '.' . $extension;
            Storage::disk('public')->put($fileName, $imageData);
            $image = $fileName;
        }

        $attendance->update([
            'check_out' => $time,
            'file_assignment_out' => $document ?? null,
            'foto_out' => $image
        ]);
    }

    private function calculatingDistance($request)
    {
        $lat = (float) $request->lat;
        $lng = (float) $request->lat;
        // $lat = -8.578888;
        // $lng = 116.086954;

        // kantor
        $baseLat1 = -8.578888;
        $baseLng1 = 116.086954;
        // lapangan
        $baseLat2 = -8.579262;
        $baseLng2 = 116.084458;

        $distance1 = GeoHelper::haversine($lat, $lng, $baseLat1, $baseLng1);
        $distance2 = GeoHelper::haversine($lat, $lng, $baseLat1, $baseLng1);

        $allowedDistance = 300; // Jarak maksimum yang diizinkan dalam meter
        if ($distance1 <= $allowedDistance || $distance2 <= $allowedDistance) {
            return true;
        } else {
            throw new InvalidFormatException();
        }
    }
}
