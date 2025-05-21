<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployesImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        while ($row[1] != null) {
                return new User([
                    'id_number' => $row[0],
                    'name_surname' => $row[1],
                    'date' => $row[2],
                    'section' => $row[3],
                    'sub_section' => $row[4],
                    'position' => $row[5],
                    'mobile' => $row[6],
                    'email' => $row[7],
                    'paid_vacation' => $row[8],
                    'day_Off' => $row[9],
                    'family_circumstances' => $row[10],
                    'bulletin' => $row[11],
                    'name' => $row[12],
                    'password' => ($row[13] ? Hash::make('admin') : Hash::make('111111')),
                    'type_id' => 4,
                ]);
            }
    }
}
