<?php

namespace App\Imports;

use App\Marca;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpParser\Node\Stmt\Return_;

class MarcasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row[2])){
        return  new Marca([
            'id'         => $row[0], //b
            'code'       => $row[1], //b
            'name'       => $row[2], //c
        ]);
        } 

      
    }
}
