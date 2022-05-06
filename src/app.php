<?php

use Parsers\JobTeaserJsonParser;
use \Parsers\RegionsJobsXmlParser;
use \Services\JobService;

/************************************
Entry point of the project.
To be run from the command line.
************************************/

define('SQL_HOST', 'mariadb');
define('SQL_USER', 'root');
define('SQL_PWD', 'root');
define('SQL_DB', 'cmc_db');
define('RESSOURCES_DIR', __DIR__ . '/../resources/');


spl_autoload_register(function($classname){
    $classname = str_replace("\\", "/", $classname);
    include_once(__DIR__ . '/' . $classname . '.php');
});

class App {
    public function run(){
        echo sprintf("Starting...\n");

        $jobService = new JobService(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);
        $jobsImporter = new JobsImporter($jobService);
        $jobTeaserParser = new JobTeaserJsonParser(RESSOURCES_DIR.'./jobteaser.json');
        $regionJobParser = new RegionsJobsXmlParser(RESSOURCES_DIR.'./regionsjob.xml');

        $jobsImporter->addParser($jobTeaserParser);
        $jobsImporter->addParser($regionJobParser);

        $count = $jobsImporter->importJobs();

        echo sprintf("> %d jobs imported.\n", $count);

        /* list jobs */
        $jobsLister = new JobsLister($jobService);
        $jobs = $jobsLister->listJobs();

        echo sprintf("> all jobs (%d):\n", count($jobs));
        foreach ($jobs as $job) {
            echo sprintf(" %d: %s - %s - %s\n", $job['id'], $job['reference'], $job['title'], $job['publication']);
        }
        echo sprintf("Done.\n");
    }
}

$app = new \App();
$app->run();