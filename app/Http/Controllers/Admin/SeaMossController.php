<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seamoss;
use Illuminate\Http\Request;

class SeaMossController extends Controller
{
    public function seamossIndex()
    {
        $data = Seamoss::first();
        return view('admin.seamoss.index', compact('data'));
    }
    public function createSeamoss()
    {
        return view('admin.seamoss.create');
    }
    public function storeSeamoss(Request $request)
    {
        $request->validate([
            'video_link' => 'required|string',
        ]);
        $videoLink = $request->input('video_link');
        $inputType = $this->detectInputType($videoLink);
        if ($inputType === 'url') {
            Seamoss::create(['link_type' => 'url', 'video_link' => $videoLink]);
        } else {
            Seamoss::create(['link_type' => 'text', 'video_link' => $videoLink]);
        }
        return redirect()->route('seamoss.index')->with(['status' => true, 'message' => 'Create Successfully']);
    }
    private function detectInputType($value)
    {
        // Check if the input value looks like a URL
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return 'url';
        } else {
            return 'text';
        }
    }
    public function editSeamoss($id)
    {
        $data = Seamoss::findOrFail($id);
        return view('admin.seamoss.edit', compact('data'));
    }

    public function updateSeamoss(Request $request, $id)
    {
        $request->validate([
            'video_link' => 'required|string',
        ]);
        $videoLink = $request->input('video_link');
        $inputType = $this->detectInputType($videoLink);
        $seamoss = Seamoss::findOrFail($id);
        $seamoss->update([
            'link_type' => $inputType,
            'video_link' => $videoLink,
        ]);
        return redirect()->route('seamoss.index')->with(['status' => true, 'message' => 'Updated Successfully']);
    }
}
