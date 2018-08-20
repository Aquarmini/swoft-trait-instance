<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Cases;

use Tests\TestCase;
use Tests\Testing\Incr;
use Tests\Testing\Incr2;

class BaseTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testInstance()
    {
        $incr = Incr::instance();

        $this->assertEquals(1, $incr->incr());

        $incr = Incr::instance('example');

        $this->assertEquals(1, $incr->incr());
        $this->assertEquals(2, $incr->incr());
    }

    public function testInstanceCo()
    {
        $incr = Incr::instance('co');
        $this->assertEquals(1, $incr->incr());
        $incr = Incr::instance('co');
        $this->assertEquals(2, $incr->incr());
        go(function () {
            $incr = Incr::instance('co');
            $this->assertEquals(1, $incr->incr());

            $incr = Incr::instance('co');
            $this->assertEquals(2, $incr->incr());
        });
        $incr = Incr::instance('co');
        $this->assertEquals(3, $incr->incr());
    }

    public function testCoUse()
    {
        $incr = Incr::instance('co_use');
        $this->assertEquals(1, $incr->incr());
        $coId = go(function () use ($incr) {
            $incr2 = Incr::instance('co_use');
            $this->assertEquals(1, $incr2->incr());

            $incr2 = Incr::instance('co_use');
            $this->assertEquals(2, $incr2->incr());

            $this->assertEquals(2, $incr->incr());
            \co::suspend(\co::getuid());
            $this->assertEquals(4, $incr->incr());
        });

        $this->assertEquals(3, $incr->incr());
        \co::resume($coId);
        $this->assertEquals(5, $incr->incr());
    }

    public function testChildInstance()
    {
        $incr = Incr::instance('child');
        $this->assertEquals(1, $incr->incr());
        $incr = Incr::instance('child');
        $this->assertEquals(2, $incr->incr());
        $incr = Incr2::instance('child');
        $this->assertEquals(1, $incr->incr());
        $incr = Incr2::instance('child');
        $this->assertEquals(2, $incr->incr());

        go(function () {
            $incr = Incr::instance('child');
            $this->assertEquals(1, $incr->incr());
            $incr = Incr::instance('child');
            $this->assertEquals(2, $incr->incr());

            $incr = Incr2::instance('child');
            $this->assertEquals(1, $incr->incr());
            $incr = Incr2::instance('child');
            $this->assertEquals(2, $incr->incr());
        });

        $incr = Incr::instance('child');
        $this->assertEquals(3, $incr->incr());
        $incr = Incr2::instance('child');
        $this->assertEquals(3, $incr->incr());
    }

    public function testInstanceKey()
    {
        $incr = Incr::instance('child');
        $this->assertEquals('child', $incr->getInstanceKey());

        go(function () {
            $incr = Incr::instance('child2');
            $this->assertEquals('child2', $incr->getInstanceKey());
        });
    }
}