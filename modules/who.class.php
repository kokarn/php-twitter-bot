<?php

class who {
    /*
     * Simple WHOIS class
     */

    private $arguments;
    private $apiUrl = 'http://whomsy.com/api/';

    private $lookupResponse = false;

    public $response = false;

    public function __construct( $arguments ){
        $this->arguments = $arguments;
    }

    public function run(){
        $this->lookupResponse = json_decode( file_get_contents( $this->apiUrl.$this->arguments ) );
        $this->handleResponse();
    }

    private function handleResponse(){
        $this->response = htmlspecialchars_decode( html_entity_decode( $this->lookupResponse->message ) );
    }

}