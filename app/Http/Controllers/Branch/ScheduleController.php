<?php

namespace App\Http\Controllers\Branch;

use Log;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('id', 'DESC')->get();
        return view('branch.schedule.index', compact('branches'));
    }


    public function saveSchedule(Request $request)
    {
        try {
            $requestData = json_decode($request->getContent(), true);

            if (!$requestData) {
                throw new \Exception('Invalid JSON data');
            }
            $branchId = $requestData['branch_id'];
            $scheduleData = $requestData['schedule_data'];
            $schedules = [];
            foreach ($scheduleData as $scheduleItem) {
                $schedule = new Schedule;
                $schedule->branch_id = $branchId;
                $schedule->name = $scheduleItem['name'];
                $schedule->start_time = $scheduleItem['start_time'];
                $schedule->end_time = $scheduleItem['end_time'];
                $schedule->save();
                $schedules[] = $schedule;
            }
            return response()->json(['message' => 'Schedules saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error saving schedules', 'details' => $e->getMessage()], 500);
        }
    }

    public function updatePickupSchedule(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|numeric',
            'pickup_time' => 'required|string',
        ]);
        $branchId = $request->input('branch_id');
        $pickupTime = $request->input('pickup_time');

        $branch = Branch::find($branchId);
        if (!$branch) {
            return response()->json(['error' => 'Branch not found'], 404);
        }
        $branch->update(['pickup_time' => $pickupTime]);
        return response()->json(['message' => 'Pickup schedule updated successfully']);
    }
}
