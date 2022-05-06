<?php
    namespace Parsers;

    class JobTeaserJsonParser extends JsonJobsParser{
        public function parse(): array
        {
            $jobs = [];
            $content = $this->getData();
            if($content && isset($content->offers)){
                foreach($content->offers as $job){
                    $jobs[] = new \Models\Job(
                        $job->reference,
                        $job->title,
                        $job->description,
                        $job->link,
                        $job->companyname,
                        $this->formattedDate($job->publishedDate)
                    );
                }
            }
            return $jobs;
        }

        public function formattedDate($date_str){
            $date = date_create_from_format("l M d H:i:s T Y", $date_str);
            $formatted =$date->format("Y/m/d");
            return $formatted;
        }
    }