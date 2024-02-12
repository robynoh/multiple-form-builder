<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;

class contactlists implements ToCollection , WithStartRow
{
    /**
    * @param Collection $collection
    */

    public function  __construct($id)
    {
        $this->id=$id;
       
    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $collection)
    {
        //
        foreach($collection as $row){

         if(($row[0]==NULL)&&($row[1]==NULL))
            {
    // Assuming that the file is finished; break the foreach parsing loop.
                break;
            }
            else{

                DB::table('contactlist')->insert(['listID'=>$this->id,'firstName'=>$row[0],'lastName'=>$row[1],'birthDay'=>$row[2],'birthMonth'=>$row[3],'phone'=>$row[4],'remarks'=>$row[5],'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')]);


            }
        }
    }
}
