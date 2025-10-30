<?php

namespace App\Http\Controllers\Home;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BranchUpdateController extends Controller
{
    public function updateBranchStatus(Request $request)
    {

        try {
            $branchId = $request->input('branch_id');
            $branches = Branch::all();

            // Update the status to 0 for all branches
            foreach ($branches as $branch) {
                $branch->status = 0;
                $branch->save();
            }

            // Update the status to 1 for the selected branch
            $selectedBranch = Branch::find($branchId);

            if (!$selectedBranch) {
                return response()->json(['message' => 'Selected branch not found.'], 404);
            }

            $selectedBranch->status = 1;
            $selectedBranch->save();

            // Update the branch_id in session
            $cart = session('cart', []);
            foreach ($cart as &$item) {
                $item['branch_id'] = $branchId;
            }
            session(['cart' => $cart]);

            return response()->json(['message' => 'Branch status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating branch status.'], 500);
        }
    }
}
