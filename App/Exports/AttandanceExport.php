<?php

namespace App\Exports;

use App\Models\Attandance;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttandanceExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attandance::all()->map(function ($user) {
            return [
                'id_number' => $user->id_number,
                'name_surname' => $user->name_surname,
                'date' => $user->date,
                'come' => $user->come,
                'go' => $user->go,
            ];
         });
    }

    public function headings(): array
    {
        return [
            'Name-Surname',
            'Date',
            'Come',
            'Go',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->name_surname,
            $attendance->date,
            $attendance->come,
            $attendance->go,
        ];
    }
}
