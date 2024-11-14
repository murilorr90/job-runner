<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetryRequest;
use App\Models\Job;
use App\Utils\JobFaker;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = [];
        $jobKeys = Redis::keys('jobs:*') ?: [];

        foreach ($jobKeys as $key) {
            $jobs[] = new Job(json_decode(Redis::get($key), true));
        }

        $jobs = Job::sortJobs($jobs);

        return view('dashboard', compact('jobs'));
    }

    public function retry(RetryRequest $request)
    {
        $jobId = $request->input('job_id');
        $jobKey = "jobs:{$jobId}";

        if (!Redis::exists($jobKey)) {
            return back()->withErrors(['message' => 'Job not found or already completed.']);
        }

        $job = json_decode(Redis::get($jobKey), true);

        $job['status'] = 'pending';
        $job['retry_count']++;

        Redis::set($jobKey, json_encode($job));

        return back()->with('success', "Job {$jobId} is being retried.");
    }

    public function examples()
    {
        $jobFaker = new JobFaker();
        $job = $jobFaker->generateJob();

        runBackgroundJob($job['class'], $job['method'], $job['params'], $job['delay'], $job['high_priority']);

        return redirect()->route('dashboard')->with('success', "Random job was added to Queue.");
    }
}
