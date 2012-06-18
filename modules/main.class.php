<?php
class main {

    public $commandTwitter = '';
    public $targetEmail = '';
    private $commandIdCache = '/var/www/twitbot/id.txt';

    private $rawCommand = '';
    private $commandId = false;

    private $command = '';
    private $arguments = '';

    private $response = false;
    private $run = false;

    public function initiate(){
        $twitter = new twitter( $this->commandTwitter );
        $twitter->getFeed();
        $this->rawCommand = $twitter->getCommand();
        $this->commandId = $twitter->getCommandId();
        $this->handleCommand();
        $this->handleCommandId();
        if( $this->run === false ) :
            die( 'Already ran this command' );
        endif;
        $this->run();
        $this->handleResponse();
    }

    private function handleCommand(){
        $commandParts = explode( ' ', $this->rawCommand );

        $commandCount = count( $commandParts );

        if( $commandCount > 2 ) :
            $arguments = '';
            for( $i = 1; $i <= $commandCount; ++$i ) :
                $arguments .= $commandParts[ $i ];
            endfor;
        else :
            $arguments = $commandParts[ 1 ];
        endif;

        $this->command = $commandParts[ 0 ];
        $this->arguments = $arguments;
    }

    private function handleCommandId(){
        $fp = fopen( $this->commandIdCache, 'c+' );
        $id = fread( $fp, filesize( $this->commandIdCache ) );
        if( $id != $this->commandId ) :
            ftruncate( $fp, 0 );
            fseek( $fp, 0 );
            fwrite( $fp, $this->commandId );
            $this->run = true;
        endif;
        fclose( $fp );
    }

    private function run(){
        $action = new $this->command( $this->arguments );
        $action->run();

        if( $action->response ) :
            $this->response = $action->response;
        endif;
    }

    private function handleResponse(){

        if( $this->response ) :

            $subject = 'Command successful';
            $message = $this->response;

        else :

            $subject = 'Command failed';
            $message = 'Failed to execute the command. Tried the following: '.$this->rawCommand;

        endif;

        mail( $this->targetEmail, $subject, $message );
    }
}
?>