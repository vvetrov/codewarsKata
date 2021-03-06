The PHP solution of https://www.codewars.com/kata/573992c724fc289553000e95

##### The challenge is as follows:

---
You have a positive number n consisting of digits. You can do at most one operation: Choosing the index of a digit in the number, remove this digit at that index and insert it back to another or at the same place in the number in order to find the smallest number you can get.

**Task:**
Return an array or a tuple or a string depending on the language (see "Sample Tests") with

the smallest number you got
the index i of the digit d you took, i as small as possible
the index j (as small as possible) where you insert this digit d to have the smallest number.
Examples:
smallest(261235) --> [126235, 2, 0] or (126235, 2, 0) or "126235, 2, 0"
126235 is the smallest number gotten by taking 1 at index 2 and putting it at index 0

smallest(209917) --> [29917, 0, 1] or ...

[29917, 1, 0] could be a solution too but index `i` in [29917, 1, 0] is greater than 
index `i` in [29917, 0, 1].
29917 is the smallest number gotten by taking 2 at index 0 and putting it at index 1 which gave 029917 which is the number 29917.

smallest(1000000) --> [1, 0, 6] or ...

---

**An elementary solution** of this problem is to iterate over all possible permutations of each digit in a number, and find the minimum value from the resulting.
In this case, the _complexity_ of the algorithm will be O(n * n) (this solution is presented in the repository for testing purposes and i called it a bruteforce).

**The solution presented by me** (in `src/findTheSmallest.php`) contains several optimizations and consists in choosing the lower value of the two ones,
obtained as a result of two different algorithms:

**_The first_** is an attempt to find the most significant digit by removing it from the result, and then choosing the minimum value from the remainders. It will be effective for moving a digit to the right as long as its value is greater than the closest digit to the right.
This algorithm has a complexity of O(n)

**_The second_** is an attempt to move the selected digit to the left as far as possible,
but so that its position is greater than the position of any digit whose value is less than the selected one.
This algorithm will be effective for moving smaller digits to the left.
The maximum complexity of this algorithm will be O (n * n / 2), but since we can execute both algorithms in the same loop,
the total maximum complexity will not exceed O(n + n * n / 2), that is, in the worst case it will be better than bruteforce,
but in the best case the it will be O(n + n), which will significantly reduce the calculations in the case of frequent use of this function.

##### There are two test methods in the test class (`test/findTheSmallestTest.php`):
- using the predefined values
- using the random generated values and comparing the result with bruteforce solution also presented in the test class.

##### PS: I written the performance test (`test/speedTest.php`)

It shows increasing performance more than twice.  (e.g. for 10000 calculations the bruteforce was used about 0.36s and my algo used about 0.15s).

##### Below is example of speedTest.php executed 3 times:
`Bruteforce: 0.32919478416443, Optimized: 0.13228106498718`  
`Bruteforce: 0.36264705657959, Optimized: 0.15237402915955`  
`Bruteforce: 0.32798194885254, Optimized: 0.1318039894104`  
`
---