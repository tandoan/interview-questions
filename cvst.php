<?php
/**
	Count number of common value subtrees.
	Given a binary tree, return the number of common value subtrees (CVST) there are.
	Leaf node by default is a valid CVST.
	Node is considered a CVST if all its descendents are CVSTs, and the node shares the same value as its descendents.
*/
	
class Node {
	public $value;
	public $left;
	public $right;

}

function countCVST($root){
	
	if(is_int($root->value)){
		if(!$root->left && !$root->right){
			return array(true, 1);
		}
	} else {
		return array(true, 0);
	}

	$l = countCVST($root->left);
	$r = countCVST($root->right);

	if(
		$l[0] and $r[0] and
		(is_null($root->left) || ($root->left->value == $root->value)) and
		(is_null($root->right) || ($root->right->value == $root->value))
	) {
		return array(true, ($l[1] + $r[1] + 1));
	} else {
		return array(false, ($l[1] + $r[1]));
	}
}

function test0(){
	$tree = new Node();
	$tree->value = 1;
	$r = countCVST($tree);
	assert($r[1] == 1);
}

function test1(){
	$tree = new Node();
	$tree->value = 7;

	$n = new Node();
	$n->value = 5;
	$tree->left = $n;

	$n32 = new Node();
	$n32->value = 7;

	$n31 = new Node();
	$n31->value = 7;

	$n2 = new Node();
	$n2->value = 7;
	$n2->left = $n31;
	$n2->right = $n32;
	$tree->right = $n2;

	$r = countCVST($tree);
	assert($r[1] == 4);
}

function test2(){
	$tree = new Node();
	$tree->value = 5;

	$n = new Node();
	$n->value = 5;

	$tree->left = $n;

	$r = countCVST($tree);
	assert($r[1] == 2);
}

function test3(){
	$tree = new Node();
	$tree->value = 5;

	$n = new Node();
	$n->value = 5;

	$n2 = new Node();
	$n2->value = 3;
	$n->left = $n2;


	$tree->left = $n;

	$r = countCVST($tree);
	assert($r[1] == 1);
}
