<?php

namespace App\Imports;

use App\Modelo;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpParser\Node\Stmt\Return_;

class ModelosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
   
        if(isset($row[3])){
        return  new Modelo([
            'id'         => $row[0], //b 
            'code_marca' => $row[2], //b
            'code'       => $row[1], //b
            'name'       => $row[3], //c
        ]); 
        }

      
    }
}
