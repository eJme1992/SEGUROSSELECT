<?php

namespace App\Imports;

use App\Auto;
use Maatwebsite\Excel\Concerns\ToModel;

class AutosExport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Auto([
            //
        ]);
    }
}
