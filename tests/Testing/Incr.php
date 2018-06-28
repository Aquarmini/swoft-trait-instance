<?php
// +----------------------------------------------------------------------
// | Incr.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Testing;

use Xin\Swoft\Traits\InstanceTrait;

class Incr
{
    use InstanceTrait;

    public $incr = 0;

    public function incr()
    {
        return ++$this->incr;
    }

    public function get()
    {
        return $this->incr;
    }
}