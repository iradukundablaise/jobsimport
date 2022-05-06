<?php

namespace Services;

use \PDO;

class JobService
{
    private $db;

    public function __construct($host, $username, $password, $databaseName){
        try{
            $this->db = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $username, $password);
        }catch(\Exception $e){
            die($e->getMessage());
        }
    }

    public function fetchAll(){
        return $this->db
            ->query('SELECT id, reference, title, description, url, company_name, publication FROM job')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($job){
        return $this->db->exec(
            'INSERT INTO job (reference, title, description, url, company_name, publication) VALUES ('
            . '\'' . addslashes($job->getRef()) . '\', '
            . '\'' . addslashes($job->getTitle()) . '\', '
            . '\'' . addslashes($job->getDescription()) . '\', '
            . '\'' . addslashes($job->getUrl()) . '\', '
            . '\'' . addslashes($job->getCompany()) . '\', '
            . '\'' . addslashes($job->getPubDate()) . '\')'
        );
    }

    public function bulkInsert($jobs){

    }

    public function removeAllJobs(){
        $this->db->exec('DELETE FROM job');
    }
}