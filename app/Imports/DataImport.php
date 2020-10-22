<?php

namespace App\Imports;


use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Data([
        //     'name'     => $row[0],
        //     'dni'    => $row[1],
        //     'key' => rand(1111111111, 9999999999),
        // ]);

        if(!Data::where('dni', '=', $row[1])->exists()) {

            return new Data([
                'name' => $row[0],
                'dni' => $row[1],
                'key' => rand(1111111111, 9999999999),
            ]);
        }


    }

}
