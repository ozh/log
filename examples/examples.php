<?php

use \Ozh\Log\Logger;

require '../vendor/autoload.php';

$logger = new Logger();

// Simple messages as strings, from lowest to highest level: debug, info, notice, warning, error, critical, alert, emergency
$logger->debug('This is a debug message');
$logger->info('This is an info message');
$logger->notice('This is a notice message');
$logger->warning('This is a warning message');
$logger->error('This is an error message');
$logger->critical('This is a critical message');
$logger->alert('This is an alert message');
$logger->emergency('This is an emergency message');


// Message with arbitrary context
$logger->info('Info message and some context', array('var' => 'value'));


// Message with an exception context
try{
    // ... here goes your code that unexpectedly raises an exception
    throw new UnexpectedValueException('This is broken');
} catch(Exception $e) {
    $logger->error( 'It failed', array('exception' => $e) );
}


// Message with an exception context and other context
try{
    // ... here goes your code that unexpectedly raises an exception
    throw new UnexpectedValueException('This is broken');
} catch(Exception $e) {
    $logger->error( 'It failed again', ['exception' => $e, 'var' => 'value'] );
}


// Exception message directly passed
try{
    // ... here goes your code that unexpectedly raises an exception
    throw new UnexpectedValueException('This is broken');
} catch(Exception $ex) {
    $logger->error($ex);
}

// Now do something with all the logged messages that have been stored in an array...
var_dump($logger->getLog());


// Expected exceptions triggered by invalid log level
// $logger = new Logger('omg');
// $logger->log('halp!', 'we have a problem');


// Define a logger with higher minimum severity :
$logger = new Logger('critical');
$logger->debug('This is a debug message');           // this won't be logged because severity is to low
$logger->info('This is an info message');            // this won't be logged because severity is to low
$logger->notice('This is a notice message');         // this won't be logged because severity is to low
$logger->warning('This is a warning message');       // this won't be logged because severity is to low
$logger->error('This is an error message');          // this won't be logged because severity is to low
$logger->critical('This is a critical message');     // this will be logged
$logger->alert('This is an alert message');          // this will be logged
$logger->emergency('This is an emergency message');  // this will be logged
var_dump($logger->getLog());


// Change minimum severity on the fly
$logger = new Logger('critical');
$logger->debug('Will not be logged');
$logger->setLevel('debug');
$logger->debug('Will be logged');
var_dump($logger->getLog());


// Custom message format defined via a callable
$custom = function($level, $message){return sprintf(('OMG!! %s AT %s! %s!!'), strtoupper($level), strtoupper(date('H:i:s')), strtoupper($message));};
$logger = new Logger();
$logger->setMessageFormat($custom);
$logger->notice('This is a notice message');
$logger->warning('This is a warning message');
var_dump($logger->getLog());

