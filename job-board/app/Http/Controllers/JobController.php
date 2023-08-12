<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{


    public function __construct(
        private JobService $jobService
    ) {
    }

    public function index(Request $request)
    {
        // $jobs = $this->jobService->all();
        // $jobs = $this->jobService->getListJobs($request);

        $filters = $request->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );
        return view(
            'job.index',
            ['jobs' => Job::with('employer')->filter($filters)->get()]
        );
        // return view('job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view(
            'job.show',
            ['job' => $this->jobService->getJobDetail($job)]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
