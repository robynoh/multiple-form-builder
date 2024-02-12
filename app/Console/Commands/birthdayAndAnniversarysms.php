<?php

namespace App\Console\Commands;
use \App\Http\Controllers\UserController;
use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class birthdayAndAnniversarysms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthdayAnniversary:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out sms to all celebrating their birthday and anniversary and also to phonebook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $month=strtotime(date(date('M')));
        $today=date(date('d'));
        $daytime=strtotime(date('h:i A'));
        $sendDate=strtotime(date('m/d/Y'));

      

        $autosmscontacts= DB::table('autosend_list')
    ->where('birthMonthString', $month)
    ->where('birthDay', $today)
    ->where('send_timeString', $daytime)
    ->get(); 

    foreach($autosmscontacts as $contact){

        $response=UserController::CURLsendsms($contact->reciever,$contact->msg,$contact->senderID);
        
        DB::table('sendmsg')->insert([
            ['userID' => $contact->userID,
             'name' => $contact->reciever_name, 
             'phone' => $contact->reciever,
             'name' => $contact->reciever_name,
             'listID'=>$contact->listID,
             'senderID'=>$contact->senderID,
             'message'=>$contact->msg,
             'status'=>$response,
             'year'=>Carbon::now()->format('Y'),
             'month'=>Carbon::now()->format('M'),
             'day'=>Carbon::now()->format('d'),
             'time'=>date('H:i:s'),
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s')
             ]
         ]);
   


    }




    $autosmsphone= DB::table('auto_send_phone_name')
        ->where('sendDateString', $sendDate)
        ->where('sendtimeString', $daytime)
        ->get(); 

        foreach($autosmsphone as $phone){


            $response=UserController::CURLsendsms($phone->phone,$phone->sms,$phone->senderID);
            
                DB::table('sendmsg')->insert([
                ['userID' => $phone->userID,
                 'name' => $phone->name, 
                 'phone' => $phone->phone,
                 'listID'=>$phone->listID,
                 'senderID'=>$phone->senderID,
                 'message'=>$phone->sms,
                 'status'=>$response,
                 'year'=>Carbon::now()->format('Y'),
                 'month'=>Carbon::now()->format('M'),
                 'day'=>Carbon::now()->format('d'),
                 'time'=>date('H:i:s'),
                 'created_at'=>date('Y-m-d H:i:s'),
                 'updated_at'=>date('Y-m-d H:i:s')
                 ]
             ]);


             DB::table('phone_schedule_sms')->where('id', $phone->autosmsID)->update(['status'=>'1']);

        }


        //return 0;
    }
}
