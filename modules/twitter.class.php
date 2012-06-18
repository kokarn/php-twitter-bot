<?php

class twitter {

    public $user = false;
    public $feed = false;
    private $feedUrl = 'https://api.twitter.com/1/statuses/user_timeline.json?screen_name=';

    public function __construct( $user ){
        $this->user = $user;
    }

    public function getFeed(){
        $feedUrl = $this->feedUrl.$this->user;

        $this->feed = json_decode( file_get_contents( $feedUrl ) );
    }

    public function getCommand(){
        return $this->feed[0]->text;
    }

    public function getCommandId(){
        return $this->feed[0]->id;
    }
}