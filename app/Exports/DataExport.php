<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{

    public function collection()
    {
        return Data::select('name', 'dni', 'number_table', 'updated_at')->where('number_table', '<>', '',)->get();
    }
}
