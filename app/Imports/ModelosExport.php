<?php

namespace App\Imports;

use App\Marca;
use Maatwebsite\Excel\Concerns\ToModel;

class MarcasExport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Marca([
            //
        ]);
    }
}
