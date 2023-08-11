<?php

namespace App\Services;

use App\Models\Job;

class JobService
{
    public function searchJobs($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    public function filterByMinSalary($query, $minSalary)
    {
        return $query->where('salary', '>=', $minSalary);
    }

    public function filterByMaxSalary($query, $maxSalary)
    {
        return $query->where('salary', '<=', $maxSalary);
    }

    public function filterByExperience($query, $experience)
    {
        return $query->where('experience', $experience);
    }

    public function filterByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getListJobs($request)
    {
        $jobs = Job::query();

        if ($search = $request->input('search')) {
            $this->searchJobs($jobs, $search);
        }

        if ($minSalary = $request->input('min_salary')) {
            $this->filterByMinSalary($jobs, $minSalary);
        }

        if ($maxSalary = $request->input('max_salary')) {
            $this->filterByMaxSalary($jobs, $maxSalary);
        }

        if ($experience = $request->input('experience')) {
            $this->filterByExperience($jobs, $experience);
        }

        if ($category = $request->input('category')) {
            $this->filterByCategory($jobs, $category);
        }

        return $jobs->get();
    }
}
