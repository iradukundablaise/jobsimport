<?php
    namespace Parsers;
    abstract  class JsonJobsParser extends Parser  implements Parserable{
        public function __construct($filename){
            parent::__construct($filename);
        }

        public function getData(){
            if(file_exists($this->getFilename())){
                $data = file_get_contents($this->getFilename());
                return json_decode($data);
            }
            return false;
        }
    }

?>