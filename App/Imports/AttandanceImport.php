<?php

namespace App\Imports;

use App\Models\Attandance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttandanceImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        while ($row[1] != null) {
        return new Attandance([
            'id_number' => $row[0],
            'name_surname' => $row[1],
            'date' => $row[2],
            'come' => $row[3],
            'go' => $row[4],
        ]);
    }
    }
}
