<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employe:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read Json File';

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
        Log::info('Cron is working fine!');
        $date = date('d.m.Y');
        $employees = '';
        $file_path = '/json/Tanamshromlebi '.$date.'.json';
        // // $path = config('config.file_path') . "/json/${filename}.json";Tanamshromlebi 20.10.2021
        $path = public_path().$file_path;
        if (json_decode(file_get_contents($path), true)) {
            $employees = json_decode(file_get_contents($path), true);
            $users = User::get();
            $users = json_decode($users, true);
            // $dismissed = array_diff($employees, $users);
            // if($dismissed != ''){
            //     foreach($dismissed as $k => $d){
            //         $dis_emp = User::where('id_number', $d->id_number)
            //         ->update(['active' => -1]);
            //     }
            // }
            if ($employees != '') {
                foreach ($employees as $key => $value) {
                    $value['birthday'] = '';
                    $value['company_email'] = '';
                    if ($value['date'] != '') {
                        $pieces = explode('.', $value['date']);
                        $brth_dat = now()->year.'-'.$pieces[1].'-'.$pieces[0];
                        $value['birthday'] = $brth_dat;
                    }
                    $value['company_email'] = $value['email'];
                    $value['email'] = $value['id_number'].'@ltb.ge';
                    $user = User::where('email', $value['email'])->first();
                    if ($user == '') {
                        User::create([
                            'id_number' => $value['id_number'],
                            'name' => $value['name_surname'],
                            'name_surname' => $value['name_surname'],
                            'email' => $value['email'],
                            'date' => $value['date'],
                            'ip_phone' => $value['ip_phone_number'],
                            'birthday' => $value['birthday'],
                            'company_email' => $value['company_email'],
                            'sub_section' => $value['sub_section'],
                            'section' => $value['section'],
                            'position' => $value['position'],
                            'mobile' => $value['mobile'],
                            'unpaid_vacation' => $value['unpaid_vacation'],
                            'bulletin' => $value['bulletin'],
                            'family_circumstances' => $value['family_circumstances'],
                            'day_Off' => $value['day_Off'],
                            'paid_vacation' => $value['paid_vacation'],
                            'bulletin' => $value['bulletin'],
                            'password' => Hash::make('1'),
                            'type_id' => 4,
                            'active' => 1,
                        ]);

                    } else {
                        $user->name_surname = $value['name_surname'];
                        $user->date = $value['date'];
                        $user->ip_phone = $value['ip_phone_number'];
                        $user->birthday = $value['birthday'];
                        $user->company_email = $value['company_email'];
                        $user->sub_section = $value['sub_section'];
                        $user->section = $value['section'];
                        $user->position = $value['position'];
                        $user->mobile = $value['mobile'];
                        $user->unpaid_vacation = $value['unpaid_vacation'];
                        $user->bulletin = $value['bulletin'];
                        $user->family_circumstances = $value['family_circumstances'];
                        $user->day_Off = $value['day_Off'];
                        $user->paid_vacation = $value['paid_vacation'];
                        $user->bulletin = $value['bulletin'];
                        $user->save();
                        Log::info('ჩანაწერი წარმატებით დარედაქტირდა');

                    }
                }
                Log::info('მშვენიერია');

            } else {
                Log::info('დღევანდელი თარიღით ფაილი ვერ მოიძებნა!');
            }
        }

        // }
         /*
           Write your database logic we bellow:
           User::create(['name'=>'test', 'email' => 'test@test.com']);
        */
    }
}
