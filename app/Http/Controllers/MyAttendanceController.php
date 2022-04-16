<?php

namespace App\Http\Controllers;

use App\Models\CheckInOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyAttendanceController extends Controller
{
    public function scanQr(Request $request)
    {
        return view('my-attendance.scan-qr');
    }

    public function storeQr(Request $request)
    {
        if (now()->format('D') == 'Sat' or now()->format('D') == 'Sun') {
            return [
                "status" => "error",
                "title" => "Today is company off-day."
            ];
        }

        if (!Hash::check(date('Y-m-d'), $request->hash_value)) {
            return [
                "status" => "error",
                "title" => "QR code is invalid"
            ];
        } else {
            $user = auth()->user();

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
}
