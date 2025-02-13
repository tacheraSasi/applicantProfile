<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show($id)
    {
        $applicant = Applicant::with(['education', 'experience', 'skills'])->findOrFail($id);
        return view('profile', compact('applicant'));
    }

    public function index() {
        $applicants = Applicant::all(); 
        return view('dashboard', compact('applicants'));
    }
    
}
