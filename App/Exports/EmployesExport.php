<?php

namespace App\Exports;

use App\Models\Employes;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employes::all();
    }

    public function headings(): array
    {
        return [
            'Id Number',
            'Name-Surname',
            'Date',
            'Section',
            'Sub Section',
            'Position',
            'Mobile',
            'Email',
            'Paid Vacation',
            'Day Off',
            'Family Circumstances',
            'Bulletin',
            'Username',
            'Password',
        ];
    }

    public function map($employ): array
    {
        return [
            $employ->id_number,
            $employ->name_surname,
            $employ->date,
            $employ->section,
            $employ->sub_section,
            $employ->position,
            $employ->mobile,
            $employ->email,
            $employ->paid_vacation,
            $employ->day_Off,
            $employ->family_circumstances,
            $employ->bulletin,
            $employ->username,
            $employ->password,
        ];
    }
}
