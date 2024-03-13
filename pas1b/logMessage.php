<?php

const DEBUG = 100;
const INFO = 75;
const NOTICE = 50;
const WARNING = 25;
const ERROR = 10;
const CRITICAL = 5;

function levelToString($loglevel){
    switch($loglevel){
        case DEBUG:
            return 'DEBUG';
        case INFO:
            return 'INFO';
        case NOTICE:
            return 'NOTICE';
        case WARNING:
            return 'WARNING';
        case ERROR:
            return 'ERROR';
        case CRITICAL:
            return 'CRITICAL';
        default:
            return '[OTHER]';
    }
}

function logMessage($message, $loglevel){

    $LOGLEVEL = 100;
    
    if ($loglevel <= $LOGLEVEL){
        $LOGDIR = 'tmp/';
        $logname = $LOGDIR . 'register.log';
    
        $file = fopen($logname, 'a+');
    
        if (!is_resource($file)){
            printf("No puedo abrir el fichero %s", $logname);
            return false;
        }
    
        date_default_timezone_set('America/New_York');
        $formatterDate = DateTimeImmutable::createFromFormat('U', time()); 
        $time = $formatterDate->format('Y-m-d H:i:s');
    
        $message = str_replace("\t", "", $message); 
        $message = str_replace("\n", "", $message); 
    
        $loglevel = levelToString($loglevel);

        $message = $time . "\t" . $loglevel . "\t" . $message . "\n";
    
        fwrite($file, $message);
        fclose($file);
        return true;
    } else {
        return false;
    }


}

// logMessage("Wor\tking\t...\n", 25);
// logMessage("Wor\tking\t...\n", 50);
// logMessage("Wor\tking\t...\n", 75);
// logMessage("Wor\tking\t...\n", 100);
// logMessage("Wor\tking\t...\n", 15);
// logMessage("Wor\tking\t...\n", 85);