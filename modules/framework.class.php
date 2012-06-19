<?php

abstract class framework {
    abstract public function run();
    abstract public function handleResponse();

    public $response = false;
    public $arguments = false;

    public function __construct( $arguments ){
        $this->arguments = $arguments;
    }
}