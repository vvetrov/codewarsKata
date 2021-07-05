<?php
require_once '../src/findTheSmallest.php';
function bruteForce($n) {
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
function test(){
    $start = microtime(true);
    for ($i=0; $i<10000; $i++) {
        $n = rand(10000,99999999999);
        bruteForce($n);
    }
    $time_elapsed_bruteforce = microtime(true) - $start;
    $start = microtime(true);
    for ($i=0; $i<10000; $i++) {
        $n = rand(10000,99999999999);
        smallest($n);
    }
    $time_elapsed_optimize = microtime(true) - $start;
    echo "Bruteforce: {$time_elapsed_bruteforce}, Optimized: {$time_elapsed_optimize}";
}
test();