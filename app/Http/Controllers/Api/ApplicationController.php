<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Mail\CareerApplicationMail;
use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'job_title' => 'required|string'
        ]);

        // Save CV with predictable name
        $file = $request->file('resume');
        $cvFileName = time() . '_' . $file->getClientOriginalName();
        $cvPath = $file->storeAs('resumes', $cvFileName);

        // Save in DB
        $application = Application::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $cvPath,
            'job_title' => $request->job_title
        ]);

        // Send Email
        Mail::to('info@iconic.com.bd')
            ->send(new CareerApplicationMail($application));

        return response()->json(['message' => 'Application submitted successfully']);
    }
}
