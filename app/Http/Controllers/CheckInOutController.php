<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CheckInOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCheckInOutRequest;
use App\Http\Requests\UpdateCheckInOutRequest;

class CheckInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hash_value = Hash::make(date('Y-m-d'));
        return view('check-inout.index', compact('hash_value'));
    }

    public function store(Request $request)
    {
        if (now()->format('D') == 'Sat' or now()->format('D') == 'Sun') {
            return [
                "status" => "error",
                "title" => "Today is company off-day."
            ];
        }
        $user = User::where("pin_code", $request->pin_code)->first();

        if (!$user) {
            return [
                "status" => "error",
                "title" => "pin code is wrong."
            ];
        }

        $check = CheckInOut::firstOrCreate([
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d')
        ]);

        if (!is_null($check->check_in) && !is_null($check->check_out)) {
            return [
                "status" => "info",
                "title" => "Already check-in and check-out today."
            ];
        }

        if (is_null($check->check_in)) {
            $check->check_in = now();
            $title =  "Successfully Check In";
            $message = $user->name . ' သည် ' . now() . ' တွင် check-in ကိုပြုလုပ်ပါသည်။';
        } else {
            if (is_null($check->check_out)) {
                $check->check_out = now();
                $title = "Successfully Check Out";
                $message = $user->name . ' သည် ' . now() . ' တွင် check-out ကိုပြုလုပ်ပါသည်။';
            }
        }

        $check->update();

        return [
            "status" => "success",
            "title" => $title,
            "message" => $message
        ];
    }

}
