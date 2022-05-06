<?php

class JobsLister
{
    private $jobService;

    public function __construct($jobService)
    {
        $this->jobService = $jobService;
    }

    public function listJobs()
    {
        return $this->jobService->fetchAll();
    }
}
