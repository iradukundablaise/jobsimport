<?php
class JobsImporter
{
    private $db;
    private $parsers;
    private $jobService;

    public function __construct($jobService)
    {
        $this->parsers = [];
        $this->jobService = $jobService;
    }

    public function addParser($parser){
        $this->parsers[] = $parser;
    }

    public function importJobs(): int
    {
        /* remove existing items */
        $this->jobService->removeAllJobs();

        /* import each item */
        $count = 0;
        foreach ($this->parsers as $parser){
            $jobs = $parser->parse();
            foreach ($jobs as $job) {
                $res = $this->jobService->insert($job);
                if($res){
                    $count++;
                }
            }
        }
        return $count;
    }
}
