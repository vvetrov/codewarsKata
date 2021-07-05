<?php

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/findTheSmallest.php';
use PHPUnit\Framework\TestCase;

class findTheSmallestTest extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertEquals($expected, $actual);
    }
    private function bruteForce($n) {
        $s = strval($n);
        $len = strlen($s);
        $smallest = $n;
        $cutPos = 0;
        $insPos = 0;
        for ($i = 0; $i < $len; $i++) {
            $digit = substr($s, $i, 1);
            $remainder = substr_replace($s,'',$i,1);
            for ($j = 0; $j < $len; $j++) {
                $tmp = intval(substr_replace($remainder,$digit,$j,0));
                if ($tmp < $smallest) {
                    $smallest = $tmp;
                    $cutPos = $i;
                    $insPos = $j;
                }
            }
        }
        return [$smallest,$cutPos,$insPos];
    }
    public function testBasic()
    {
        $this->revTest(smallest(261235), [126235, 2, 0]);
        $this->revTest(smallest(209917), [29917, 0, 1]);
        $this->revTest(smallest(285365), [238565, 3, 1]);
        $this->revTest(smallest(802458), [24588, 0, 4]);
    }

    public function testRandom()
    {
        for ($i = 0; $i < 10000; $i++) {
            $n = rand(10000,99999999999);
            $this->revTest(smallest($n), $this->bruteForce($n));
        }
    }
}