<?php

class who extends framework {
    /*
     * Simple WHOIS class
     */
    private $apiUrl = 'http://whomsy.com/api/';
    private $lookupResponse = false;

    public function run(){
        $this->lookupResponse = json_decode( file_get_contents( $this->apiUrl.$this->arguments ) );
        $this->handleResponse();
    }

    private function handleResponse(){
        $this->response = htmlspecialchars_decode( html_entity_decode( $this->lookupResponse->message ) );
    }

}