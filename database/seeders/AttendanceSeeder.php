<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\CheckInOut;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $periods = new CarbonPeriod('2021-01-01', date('Y-m-d'));
            foreach ($periods as $period) {
                if ($period->format('D') != 'Sat' and $period->format('D') != 'Sun') {
                    $attendance = new CheckInOut();
                    $attendance->user_id = $user->id;
                    $attendance->date = $period->format('Y-m-d');
                    $attendance->check_in = Carbon::parse($period->format('Y-m-d') . ' ' . '09:00:00')->subMinutes(rand(1, 55));
                    $attendance->check_out = Carbon::parse($period->format('Y-m-d') . ' ' . '18:00:00')->addMinutes(rand(1, 55));
                    $attendance->save();
                }
            }
        }
    }
}
