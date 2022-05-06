<?php

namespace Parsers;

class RegionsJobsXmlParser extends XmlJobsParser
{
    public function parse()
    {
        $jobs = [];
        $items = $this->getData();
        if($items){
            foreach($items as $job){
                $jobs[] = new \Job(
                    (string) $job->ref,
                    (string) $job->title,
                    (string) $job->description,
                    (string) $job->url,
                    (string) $job->company,
                    (string) $job->pubDate
                );
            }
        }
        return $jobs;
    }
}