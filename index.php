<?php

$commandTwitter = '';
$targetEmail = '';

function __autoload($class_name) {
    include 'modules/' . $class_name . '.class.php';
}

$main = new main();
$main->commandTwitter = $commandTwitter;
$main->targetEmail = $targetEmail;
$main->initiate();