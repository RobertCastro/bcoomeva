<?php

namespace App\Imports;


use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;

class DataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Data([
            'name'     => $row[0],
            'dni'    => $row[1],
            'number_table' => " ",
        ]);
    }
}
