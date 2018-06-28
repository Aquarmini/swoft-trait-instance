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
        });
    }
}