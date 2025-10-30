<?php

namespace App\Http\Controllers\Home;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use App\Http\Controllers\Controller;

class SecurityController extends Controller
{
    public function getFaqs()
    {
        $data = Faq::orderby('id', 'DESC')->get();
        return view('home.faqs', compact('data'));
    }
    public function getPrivacyPolicy()
    {
        $data = PrivacyPolicy::first();
        return view('home.privacy-policy', compact('data'));
    }
    public function getTermCondition()
    {
        $data = TermCondition::first();
        return view('home.terms-conditions', compact('data'));
    }
}
