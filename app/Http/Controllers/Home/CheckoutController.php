<?php

namespace App\Http\Controllers\Home;

use App\Models\Branch;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Models\UserTimeSlotes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
   public function getCheckout(){
    $branchess = Branch::all();
    $userId = Auth::guard('user')->id();
    $userTimeSlots = UserTimeSlotes::where('user_id', $userId)
        ->first();
    $timeSlots = TimeSlot::all();
    return view('home.checkout',compact('timeSlots','userTimeSlots','branchess'));

   }
}
