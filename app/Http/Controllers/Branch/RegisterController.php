<?php

namespace App\Http\Controllers\Branch;

use App\Models\Branch;
use App\Mail\testingMail;
use Illuminate\Http\Request;
use App\Mail\RegisterSuccessMail;
// use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function getBranchRegistor()
    {

        return view('branch.auth.register');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:branches,email',
                'phone_number' => 'required|numeric',
                'branch_number' => 'required|numeric',
                'location' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $branch = new Branch();
            $branch->name = $validatedData['name'];
            $branch->email = $validatedData['email'];
            $branch->phone_number = $validatedData['phone_number'];
            $branch->branch_number = $validatedData['branch_number'];
            $branch->location = $validatedData['location'];
            $branch->password = Hash::make($validatedData['password']);
            $branch->save();
            Mail::to($branch->email)->send(new RegisterSuccessMail);
            return redirect()->route('branch')->with(['status' => true, 'message' => 'Register Successfully']);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Something went wrong. Please try again later.');
        }
    }
}
