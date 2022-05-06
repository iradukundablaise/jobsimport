<?php

use Parsers\JobTeaserJsonParser;
use \Parsers\RegionsJobsXmlParser;

/************************************
Entry point of the project.
To be run from the command line.
************************************/

define('SQL_HOST', 'mariadb');
define('SQL_USER', 'root');
define('SQL_PWD', 'root');
define('SQL_DB', 'cmc_db');
define('RESSOURCES_DIR', __DIR__ . '/../resources/');


// __autoload function is deprecated since PHP 7.0
/*
function __autoload(string $classname) {
    include_once(__DIR__ . '/' . $classname . '.php');
}
*/

spl_autoload_register(function($classname){
    $classname = str_replace("\\", "/", $classname);
    include_once(__DIR__ . '/' . $classname . '.php');
});

echo sprintf("Starting...\n");

$jobsImporter = new JobsImporter(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

$jobTeaserParser = new JobTeaserJsonParser(RESSOURCES_DIR.'./jobteaser.json');
$regionJobParser = new RegionsJobsXmlParser(RESSOURCES_DIR.'./regionsjob.xml');

$jobsImporter->addParser($jobTeaserParser);
$jobsImporter->addParser($regionJobParser);

$count = $jobsImporter->importJobs();

echo sprintf("> %d jobs imported.\n", $count);


/* list jobs */
$jobsLister = new JobsLister(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);
$jobs = $jobsLister->listJobs();

echo sprintf("> all jobs (%d):\n", count($jobs));
foreach ($jobs as $job) {
    echo sprintf(" %d: %s - %s - %s\n", $job['id'], $job['reference'], $job['title'], $job['publication']);
}


echo sprintf("Done.\n");