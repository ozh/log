<?php

namespace Ozh\Log;

use Ozh\Log\Logger;

class Dummy {
    private $message = "message";
    
    public function __toString(){
        return $this->message;
    }
}

class DummyNoString {
    private $message = "message";
}

class LoggerTest extends \PHPUnit\Framework\TestCase
{

    public function logLevels()
    {
        return array(
            array('debug'),
            array('info'),
            array('notice'),
            array('warning'),
            array('error'),
            array('critical'),
            array('alert'),
            array('emergency'),
        );
    }

    public function testCreateDefaultLogger()
    {
        $logger = new Logger();
        $this->assertTrue($logger instanceof Logger);
        $this->assertSame($logger->getMessageFormat(), array($logger,'defaultFormat'));
    }

    /**
     * @dataProvider logLevels
     */    
    public function testCreateLoggerWithLevel($level)
    {
        $logger = new Logger($level);
        $this->assertTrue($logger instanceof Logger);
        $this->assertSame($logger->getLevel(), $level);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateLoggerWithInvalidLevel()
    {
        $logger = new Logger('omg');
    }

    /**
     * @dataProvider logLevels
     */    
    public function testLogLevels($level)
    {
        $logger = new Logger();
        $this->assertSame(0,count($logger->getLog()));
        $logger->$level('message');
        $this->assertSame(1,count($logger->getLog()));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLogLevelInvalid()
    {
        $logger = new Logger();
        $logger->log('omg', 'this is very dangerous');
    }

    public function testLogObject()
    {
        $logger = new Logger();
        $this->assertSame(0,count($logger->getLog()));
        $object = new Dummy;
        $logger->error($object);
        $this->assertSame(1,count($logger->getLog()));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLogInvalidMessageType()
    {
        $logger = new Logger();
        $object = new DummyNoString;
        $logger->error($object);
    }

    public function testLogContext()
    {
        $logger = new Logger();
        $this->assertSame(0,count($logger->getLog()));
        $logger->error('message', array('var'=>'value'));
        $this->assertSame(1,count($logger->getLog()));
    }

    public function testLogContextWithException()
    {
        $logger = new Logger();
        $e = new \Exception('message');
        $this->assertSame(0,count($logger->getLog()));
        $logger->error('error', array('exception' => $e));
        $this->assertSame(1,count($logger->getLog()));
    }

    public function testChangeLevel()
    {
        $logger = new Logger('critical');
        $this->assertSame(0,count($logger->getLog()));
        $logger->debug('Will not be logged');
        $this->assertSame(0,count($logger->getLog()));
        $logger->setLevel('debug');
        $logger->debug('Will be logged');        
        $this->assertSame(1,count($logger->getLog()));
    }

    public function testCustomLogger()
    {
        $logger = new Logger();
        $custom = function($level, $message){return 'Wrong';};
        $logger->setMessageFormat($custom);
        $this->assertSame(0,count($logger->getLog()));
        $logger->debug('Right');
        $this->assertSame(1,count($logger->getLog()));
        $this->assertSame(array('Wrong'),$logger->getLog());
    }

}
