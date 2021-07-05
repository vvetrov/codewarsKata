<?php
function smallest($n)
{
    $s = strval($n); // string representation of the given number
    $minIdx = 0; // index of digit to move using method 1
    $len = strlen($s);
    $minCalc = null;
    $minCalcIdx = 0; // index of digit to move using method 2
    $minIns = 0; // calculated position of inserted digit
    $minVal = null;
    for ($i = 0; $i < $len; $i++) {
        //method 1: trying to find an index of digit ($minIdx) to move by finding the minimum value ($minVal) after deleting it
        $tmp = substr_replace($s, '', $i, 1);
        if ($minVal === null || $minVal > intval($tmp)) {
            $minVal = intval($tmp);
            $minIdx = $i;
        }
        //method 2: trying to get the final result by moving the digit to a position to the left of the first greater or equal digit
        $digit = substr($s, $i, 1);
        $ins = 0;
        while ($digit > substr($s, $ins, 1)) {
            $ins++;
        }
        $tmp2 = intval(substr_replace($tmp, $digit, $ins, 0));
        if ($minCalc === null || $minCalc > $tmp2) {
            $minCalc = $tmp2;
            $minCalcIdx = $i;
            $minIns = $ins;
        }
    }
    // procesing the result of the method 1
    $digit = substr($s, $minIdx, 1);
    $leftVal = substr_replace($s, '', $minIdx, 1);
    $insertPos = 0;
    //moving digit subscribed above to the right of the first greater or equal digit
    while ($insertPos < $len-1 && $digit >= substr($leftVal, $insertPos, 1)) {
        $insertPos++;
    }
    //it's need to take care that we should move the digit as most righter that is possible, but to the left of the similar digit
    while ($insertPos > 0 && $digit === substr($leftVal, $insertPos-1,1)) {
        $insertPos--;
    }
    $result = intval(substr_replace($leftVal, $digit, $insertPos, 0));
    //workaround for case when there is no way to optimize (result is equal to source)
    if ($result === $n) {
        $insertPos = 0;
    }
    // comparing of given result with result of method 2
    if ($minCalc < $result) {
        $result = $minCalc;
        $minIdx = $minCalcIdx;
        $insertPos = $minIns;
    }
   // make sure that $minIdx < $insertPos when it is possible to swap them
    if ($minIdx - $insertPos === 1) {
        $t = $minIdx;
        $minIdx = $insertPos;
        $insertPos = $t;
    }
    return [$result, $minIdx, $insertPos];
}