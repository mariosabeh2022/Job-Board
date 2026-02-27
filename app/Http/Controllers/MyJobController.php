<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAnyEmployer', Job::class);
        return view('my_job.index', [
            'jobs' => $request->user()->employer->jobs()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Job::class); 
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->authorize('create',Job::class);
        $request->user()->employer->jobs()->create($request->validated());
        return redirect()->route('my-jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('my_job.edit', [
            'job' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $job)
    {
        $this->authorize('update', $job);
        $job->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
