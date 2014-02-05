<?php
/**- Create a class hierarchy involving:


  * Jewelry with children of ring, necklace and bracelete.
  * Create attributes size, weight, price, color.

  * Implement method "wash" on each kind of object (ring, necklace & bracelete). The "wash" method would be different on each one.  

  "This is assuming that not all jewlery is washable.  If it is, I'd throw method wash in the Jewlery abstract class"
*/



abstract class Jewlery {
	private $size;
	private $weight;
	private $price;
	private $color;

	private $washBehavior;

	public function wash(){
		$this->washBehavior->wash();
	}
}

interface WashBehavior{
	public function wash();
}

class RingWash implements WashBehavior(){
	public function wash(){
		//dunk in a glass of soda
	}
}

class Ring extends Jewlery{
	public function __construct($washBehavior){
		$this->washBehavior = $washBehavior;
	}
}

class JewleryFactory{
	public function createRing(){
		$ring = new Ring(new RingWash());
	}
}