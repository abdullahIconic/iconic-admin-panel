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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'job_title' => 'required|string'
        ]);

        $file = $request->file('resume');
        $cleanName = preg_replace('/[^A-Za-z0-9\.\-_]/', '-', $file->getClientOriginalName());
        $cvFileName = time() . '_' . $cleanName;
        $cvPath = $file->storeAs('resumes', $cvFileName);

        $application = Application::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $cvPath,
            'job_title' => $request->job_title
        ]);
        Mail::to('abdullahfardeen.iconic@gmail.com')
            ->send(new CareerApplicationMail($application));

        return response()->json(['message' => 'Application submitted successfully']);
    }
}
