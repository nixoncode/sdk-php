<?php

declare(strict_types=1);

namespace Advanta\Test;

use Advanta\Advanta;
use Advanta\Airtime;
use Mockery;

class AdvantaTest extends TestCase
{
    public function testGetHello()
    {
        $object = Mockery::mock(Advanta::class);
        $object->shouldReceive('getHello')->passthru();

        $this->assertSame('Hello, World!', $object->getHello());
    }
    
    public function testShouldCreateAirtimeObject()
    {
        $object = new Advanta('key', 'token');
        $this->assertInstanceOf(Airtime::class, $object->airtime());
    }
}
