<?php
    namespace Parsers;

    abstract class Parser{
        protected $filename;

        public function __construct($filename){
            $this->filename = $filename;
        }

        public function getFilename(): string {
            return $this->filename;
        }

        public function setFilename($filename){
            $this->filename = $filename;
        }

        public abstract function getData();
    }