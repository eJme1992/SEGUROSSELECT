<?php

namespace App\Imports;

use App\Auto;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpParser\Node\Stmt\Return_;

class AutosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
   
        if(isset($row[3])){
        return  new Auto([
            'id'         => $row[0], //b
            'code_Auto'  => $row[1], //b
            'code'       => $row[2], //b
            'name'       => $row[3], //c
        ]); 
        }

      
    }
}
