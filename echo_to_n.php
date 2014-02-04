<?php
/**
Write a functioin that takes a positive integer and outputs 1-N.
*/

function iterative($n){
	for($x=1;$x<=$n;$x++){
		echo "$x\n";
	}
}

function recursive($n){
	if($n > 0){
		recursive($n-1);
		echo "$n\n";
	}
}

//iterative(10);
recursive(10);