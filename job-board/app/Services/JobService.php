<?php

namespace App\Services;

use App\Models\Job;

class JobService extends BaseService
{
    public function __construct(Job $job)
    {
        parent::__construct($job);
    }

    public function getListJobs($request)
    {
        // $jobs = Job::query();

        // if ($search = $request->input('search')) {
        //     $this->searchJobs($jobs, $search);
        // }

        // if ($minSalary = $request->input('min_salary')) {
        //     $this->filterByMinSalary($jobs, $minSalary);
        // }

        // if ($maxSalary = $request->input('max_salary')) {
        //     $this->filterByMaxSalary($jobs, $maxSalary);
        // }

        // if ($experience = $request->input('experience')) {
        //     $this->filterByExperience($jobs, $experience);
        // }

        // if ($category = $request->input('category')) {
        //     $this->filterByCategory($jobs, $category);
        // }
        // return $jobs->get();


        //Use scoped
        $filters = $request->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );
        return Job::filter($filters)->get();
    }

    public function getJobDetail(Job $job)
    {
        return $job->load('employer.jobs');
    }

    // private function searchJobs($query, $search)
    // {
    //     return $query->where(function ($query) use ($search) {
    //         $query->where('title', 'like', '%' . $search . '%')
    //             ->orWhere('description', 'like', '%' . $search . '%')->orWhereHas('employer', function ($query) use ($search) {
    //                 $query->where('company_name', 'like', '%' . $search . '%');
    //             });
    //     });
    // }

    // private function filterByMinSalary($query, $minSalary)
    // {
    //     return $query->where('salary', '>=', $minSalary);
    // }

    // private function filterByMaxSalary($query, $maxSalary)
    // {
    //     return $query->where('salary', '<=', $maxSalary);
    // }

    // private function filterByExperience($query, $experience)
    // {
    //     return $query->where('experience', $experience);
    // }

    // private function filterByCategory($query, $category)
    // {
    //     return $query->where('category', $category);
    // }
}
