<?php
/**
	Given an array of size N, which contains only elements with values of [1..N-1],
	return a value in the array that is contained more than once
*/


function n_squared($a){
	$c = count($a);
	for ($i = 0;$i<$c;$i++) {
		for ($j = 0;$j<$c;$j++) {
			if($i != $j && $a[$i] == $a[$j] ) {
				return $a[$i];
			}
		}
	}
	return false;
}

// O(n) time and O(n) space.
// Iterate through the array, generating a hash as we go.  Once we hit a duplicate return.
function hash_method($a){
	$h = array();
	foreach ($a as $v) {
		if(isset($h[$v])) {
			return $v;
		} else {
			$h[$v] = true;
		}
	}
	return false;
}

// O(n) and O(n) space.
// Remove the if statement from the hash method by starting with a 0 filled array.
// Slightly faster in theory than the hash method due to not having the else clause.
function array_method($a){
	$tmpArray = array_fill(0,count($a),0);

	foreach($a as $v) {
		$tmpArray[$v-1] ++;
		if($tmpArray[$v-1] >1) {
			return $v;
		}
	}
}

// Better than O(n^2) time, little additional memory, works on read only arrays
// Because we are guranteed N elements with a range of [1..N-1]
// We are guranteed at least one duplicate.
// Thus, if we split the search space in half, then count the numbers in the search space
// If we encounter more numbers that match the search than the number of elements, the dupe must be in that range.
// Example: 1,2,3,4,5,2
// Search  1-3, 4-5.  Only 3 possible elements between 1..3, and 2 between 4..5
// Scan for number of elements between 1..3, and between 4..5.
// If there are more than 3 elements between 1..3, answer is between 1 and 3.
// If there are more than 2 elemetns between 4..5, answer is 4 or 5.

// Possible bug with lots of data: overflow when calculating bounds?
function binary_search($a){
	$c = count($a);
	return binary_search_helper($a,1,$c-1);
}

function binary_search_helper($a,$lowerBound,$upperBound){
	// case when range is separated by 1 or equal
	if(($lowerBound +1) >= $upperBound){
		$h = array();
		foreach($a as $v){
			if(isset($h[$v])){
				return $v;
			} else {
				$h[$v] = 0;
			}
		}
		return false;
	} else {
		$lowerHalfCount = 0;
		// Scan and count up numbers within the range
		$lowerHalfUpperBound = floor($upperBound/2);
		foreach($a as $v){
			if( $lowerBound <= $v && $v <= $lowerHalfUpperBound){
				$lowerHalfCount++;
			}
		}

		if($lowerHalfCount > ($lowerHalfUpperBound-$lowerBound+1)) {
			$lower = binary_search_helper($a, $lowerBound, floor(($lowerHalfUpperBound/2)-1));	
			$upper = binary_search_helper($a, floor($lowerHalfUpperBound/2), $lowerHalfUpperBound);	
			if(is_int($lower)){
				return $lower;
			}
			return $upper;
		} else {
			$lower = binary_search_helper($a, $lowerHalfUpperBound+1, floor(($upperBound+$lowerHalfUpperBound)/2));	
			$upper = binary_search_helper($a, floor(($upperBound+$lowerHalfUpperBound)/2)+1, $upperBound);		
			if(is_int($lower)){
				return $lower;
			}
			return $upper;
		}
	}
}

function run_asserts($a, $expectedValue){
	assert (n_squared($a) == $expectedValue);
	assert (hash_method($a) == $expectedValue);
	assert (array_method($a) == $expectedValue);
	assert (binary_search($a) == $expectedValue);
}

$a = array (1,2,3,4,5,2);
run_asserts($a, 2);
echo "1 passed\n";

$a = array (1,4,3,4,5,2);
run_asserts($a, 4);
echo "2 passed\n";

$a = array (1,2,3,4,4);
run_asserts($a, 4);
echo "3 passed\n";

$a = array (1,2,3,1);
run_asserts($a, 1);
echo "4 passed\n";


$a = array (1,1);
run_asserts($a, 1);
echo "5 passed\n";


$a = array (1,2,1);
run_asserts($a, 1);
echo "6 passed\n";

run_asserts(array(1,2,3,4,5,6,8,8,8), 8);

run_asserts( array( 1,2,3,3,4,5,6), 3);
run_asserts( array( 1,2,3,5,4,5,6), 5);
run_asserts( array( 1,2,3,5,4,6,6), 6);


run_asserts( array( 1,2,3,5,4,6,6,7), 6);
run_asserts( array( 1,2,1,5,4,6,1,7), 1);
run_asserts( array( 1,2,3,5,4,1,6,7), 1);
run_asserts( array( 1,2,3,5,4,7,7,7), 7);



