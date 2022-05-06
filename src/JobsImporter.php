<?php
class JobsImporter
{
    private $db;
    private $parsers;

    public function __construct($host, $username, $password, $databaseName)
    {
        $this->parsers = [];
        /* connect to DB */
        try {
            $this->db = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $username, $password);
        } catch (Exception $e) {
            die('DB error: ' . $e->getMessage() . "\n");
        }
    }

    public function addParser($parser){
        $this->parsers[] = $parser;
    }

    public function importJobs(): int
    {
        /* remove existing items */
        $this->db->exec('DELETE FROM job');
        /* import each item */
        $count = 0;
        foreach ($this->parsers as $parser){
            $jobs = $parser->parse();
            foreach ($jobs as $job) {
                $res = $this->db->exec(
                    'INSERT INTO job (reference, title, description, url, company_name, publication) VALUES ('
                    . '\'' . addslashes($job->getRef()) . '\', '
                    . '\'' . addslashes($job->getTitle()) . '\', '
                    . '\'' . addslashes($job->getDescription()) . '\', '
                    . '\'' . addslashes($job->getUrl()) . '\', '
                    . '\'' . addslashes($job->getCompany()) . '\', '
                    . '\'' . addslashes($job->getPubDate()) . '\')'
                );
                if($res){
                    $count++;
                }
            }
        }
        return $count;
    }
}
