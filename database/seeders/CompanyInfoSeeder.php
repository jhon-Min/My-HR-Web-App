<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
use Illuminate\Database\Seeder;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!CompanyInfo::exists()) {
            $setting = new CompanyInfo();
            $setting->name = "The Creator Myanmar";
            $setting->email = "creatormm@gmail.com";
            $setting->phone =  "09773849931";
            $setting->address = "Sanchaung Tsp, Yangon";
            $setting->office_start_time = "09:00:00";
            $setting->office_end_time = "18:00:00";
            $setting->break_start_time = "12:00:00";
            $setting->break_end_time = "13:00:00";
            $setting->save();
        }
    }
}
