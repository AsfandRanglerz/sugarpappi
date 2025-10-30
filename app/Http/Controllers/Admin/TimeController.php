<?php

namespace App\Http\Controllers\admin;

use App\Models\TimeSlot;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class TimeController extends Controller
{
    public function index()
    {
        $existingTimeSlotsCount = TimeSlot::count();
        $existingTimeSlot = TimeSlot::first();
        return view('admin.timeslots.index', compact('existingTimeSlotsCount', 'existingTimeSlot'));
    }
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'start_pickup_time' => 'required',
                'end_pickup_time' => 'required',
            ]);
            $action = $request->input('action', 'add');
            if ($action === 'update') {
                $existingTimeSlot = TimeSlot::first();
                $existingTimeSlot->update([
                    'start_pickup_time' => $validateData['start_pickup_time'],
                    'end_pickup_time' => $validateData['end_pickup_time'],
                ]);
                return redirect()->back()->with([
                    'status' => true,
                    'message' => 'Time Slot updated successfully',
                    'start_pickup_time' => $existingTimeSlot->start_pickup_time,
                    'end_pickup_time' => $existingTimeSlot->end_pickup_time,
                ]);
            } else {
                $timeSlot = new TimeSlot();
                $timeSlot->start_pickup_time = $validateData['start_pickup_time'];
                $timeSlot->end_pickup_time = $validateData['end_pickup_time'];
                $timeSlot->save();
                return redirect()->back()->with([
                    'status' => true,
                    'message' => 'Time Slot added successfully',
                    'start_pickup_time' => $timeSlot->start_pickup_time,
                    'end_pickup_time' => $timeSlot->end_pickup_time,
                ]);
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => 'An error occurred while saving the time slot.']);
        }
    }
}
