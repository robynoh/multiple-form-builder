<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use DB;

class ResponseExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function  __construct($table)
    {
        $this->tableid= $table;
       
    }



    public function get_table_name($id)
    {
        $tname= DB::table('table_list')->where('id',$id)->first();
        return $tname->tablename;

    }



    public function collection()
    {
        //
        return  $records= DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($this->tableid))->get(); 
    }

    

}
