<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class contactList implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function  __construct($id)
    {
        $this->id=$id;
       
    }

    public function collection(Collection $collection)
    {
        //

        foreach($collection as $row){

            

            DB::table('contactlist')->insert(['listID'=>$this->id,'firstName'=>$row[0],'lastName'=>$row[1],'birthDay'=>$row[2],'birthMonth'=>$row[3],'phone'=>$row[4],'remarks'=>$row[5]]);


        }
    }
}
