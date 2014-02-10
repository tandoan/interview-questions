<?php
/**- Create a class hierarchy involving:


  * Jewelry with children of ring, necklace and bracelete.
  * Create attributes size, weight, price, color.

  * Implement method "wash" on each kind of object (ring, necklace & bracelete). The "wash" method would be different on each one.  

  "This is assuming that not all jewlery is washable.  If it is, I'd throw method wash in the Jewlery abstract class"
*/
interface iWashMethod {
	public function wash();
}

class SoakInBakingSoda implements iWashMethod {
	public function wash() {
		//soak it
	}
}
class NoWash implements iWashMethod {
	public function wash() {
		//no washing possible
	}
}
class ScrubHard implements iWashMethod {
	public function wash() {
		//scrub a dub dub
	}
}


class Jewlery {
	private $size;
	private $weight;
	private $price;
	private $color;

	private $washMethod;

	public function __construct($size, $weight, $price, $color, $washMethod) {
		$this->size = $size;
		$this->weight = $weight;
		$this->price = $price;
		$this->color = $color;
		$this->washMethod = $washMethod;
	}

	public function doWash() {
		$this->washMethod->wash();
	}

	public function getSize() {
		return $this->size;
	}
	public function setSize($s) {
		$this->size = $s;
	}

	public function getWeight() {
		return $this->weight;
	}
	public function setWeight($w) {
		$this->weight = $w;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($p) {
		$this->price = $p;
	}

	public function getColor() {
		return $this->color;
	}
	public function setColor($c) {
		$this->color = $c;
	}

	public function getWashMethod() {
		return $this->washMethod;
	}
	public function setWashMethod($w) {
		$this->washMethod = $w;
	}
}

class Ring extends Jewlery {}

class Necklace extends Jewlery {}

class Bracelete extends Jewlery {}

class JewleryFactory {
	public function createLargeRedRing() {
		$o = new Ring('L', '1.5g', '2.50', 'RED', new ScrubHard());
		return $o;
	}

	public function createFeatherNecklace() {
		$o = new Necklace('L', '2.5g', '10.99', 'GOLD', new NoWash());
		return $o;
	}
}

$ring = JewleryFactory::createLargeRedRing();
$necklace = JewleryFactory::createFeatherNecklace();