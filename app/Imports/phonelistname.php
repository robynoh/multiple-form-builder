<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;

class phonelistname implements ToCollection , WithStartRow
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
   
                   DB::table('phonenamelist')->insert(['listID'=>$this->id,'name'=>$row[0],'phone'=>$row[1],'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')]);
   
   
               }
           }







    }
}
