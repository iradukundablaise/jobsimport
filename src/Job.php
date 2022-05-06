<?php

class Job{
    private $ref;
    private $title;
    private $description;
    private $url;
    private $company;
    private $pubDate;

    public function __construct($ref, $title, $description, $url, $company, $pubDate){
        $this->ref = $ref;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->company = $company;
        $this->pubDate = $pubDate;
    }

    public function getRef(){
        return $this->ref;
    }
    public function setRef($ref){
        $this->ref = $ref;
    }

    public function getTitle(){ 
        return $this->title; 
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function getUrl(){
        return $this->url;
    }
    public function setUrl($url){
        $this->url = $url;
    }

    public function getCompany(){
        return $this->company;
    }
    public function setCompany($company){
        $this->company = $company;
    }

    public function getPubDate(){
        return $this->pubDate;
    }
    public function setPubDate($pubDate){
        $this->pubDate = $pubDate;
    }

    public function __toString(){
        return  "Job {"
                    ."ref: ". $this->ref ."\n"
                    ."title: ". $this->title ."\n"
                    ."description: ". $this->description ."\n"
                    ."url: ". $this->url ."\n"
                    ."company: ". $this->company ."\n"
                    ."pubDate: ". $this->pubDate
                ."}";
    }
}

?>