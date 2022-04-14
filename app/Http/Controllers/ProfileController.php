<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "profile_img" => "required|mimes:png,jpg|max:10000"
        ]);
        $id = Auth::user()->id;
        $employee = User::findOrFail($id);

        if($employee->profile_img){
            Storage::disk('public')->delete('employee/' . $employee->profile_img);
        }

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $newName, file_get_contents($file));

            $employee->profile_img = $newName;
            $employee->update();
        }

        return redirect()->route('profile.index')->with('toast', ['icon' => 'success', 'title' => 'Successfully Updated']);
    }
}
