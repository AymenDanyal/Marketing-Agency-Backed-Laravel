<?php
// app/Http/Controllers/JobController.php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('pages.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('pages.jobs.create');
    }

    public function store(Request $request)
    {
        Job::create($request->all());
        return redirect()->route('jobs.index');
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('pages.jobs.show', compact('job'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('pages.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->route('jobs.index');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('jobs.index');
    }
}

