<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->slice(2)->each(function ($row) {
            $string = $row[2];
            $cleanedString = ltrim($string, "'");
            $nip = intval($cleanedString);

            User::updateOrCreate(
                [
                    'name' => $row[1],
                    'nip' => $nip,
                    'password' => $nip,
                    'position' => $row[3],
                    'is_admin' => 0,
                    'status' => 1
                ],
                [
                    'name' => $row[1],
                    'position' => $row[3],
                ]
            );
        });
    }
}
