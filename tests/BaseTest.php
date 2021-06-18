<?php

declare(strict_types=1);

namespace App\Test;

use App\Base;

class BaseTest extends TestCase
{
    public function testGetHello()
    {
        $object = \Mockery::mock(Base::class);
        $object->shouldReceive('getHello')->passthru();

        $this->assertSame('Hello, World!', $object->getHello());
    }
}
