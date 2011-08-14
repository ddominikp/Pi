<?php
class Pi{
	private $k;
	private $scale;
	function __construct($k=NULL, $scale=NULL){
		if($k && $scale){
			if(is_numeric($k) && $k>0 && is_numeric($scale) && $scale>0){
				$this->k = $k;
				$this->scale = $scale;	
			} else {
				throw new Exception('\$k and \$scale must be bigger than zero.');	
			}
		}
	}
	function setK($k){
		if(is_numeric($k) && $k>0){
			$this->k = $k;
			return true;	
		} else {
			throw new Exception("\$k must be bigger than zero.");	
		}
	}
	function getK(){
		return $this->k;	
	}
	function setScale($scale){
		if(is_numeric($scale) && $scale>0){
			$this->scale = $scale;
			return true;	
		} else {
			throw new Exception("\$scale must be bigger than zero.");	
		}
	}
	function getScale(){
		return $this->scale;	
	}
	private function factorial($n){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$factorial=1;
		for($i=$n; $i>0; $i--){
			$factorial = bcmul($factorial, $i, $this->scale);
		}
		return $factorial;
	}
	private function doublefactorial($n){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$doublefactorial=1;
		for($i=$n; $i>0; $i-=2){
			$doublefactorial = bcmul($doublefactorial, $i, $this->scale);
		}
		return $doublefactorial;
	}
	function newton(){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$div_2 = 0;
		for($i=0; $i<=$this->k; $i++){
			$div_2 = bcadd($this->factorial($i)/($this->doublefactorial(2*$i+1)), $div_2, $this->scale);
		}
		$pi = bcmul($div_2, 2, $this->scale);
		return $pi;
	}
	function viete(){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$sqrt = bcsqrt(2, $this->scale);
		$two_div_pi = 1;
		for($i=0; $i<=$this->k; $i++){
			$two_div_pi = bcmul(bcdiv($sqrt, 2, $this->scale), $two_div_pi, $this->scale);
			$sqrt = bcsqrt(2+$sqrt, $this->scale);
		}
		$one_div_pi = bcdiv($two_div_pi, 2, $this->scale);
		$pi = bcdiv(1, $one_div_pi, $this->scale);
		return $pi;	
	}
	function leibniz(){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$div_4 = 0;
		for($i=0; $i<=$this->k; $i++){
			$div_4 += bcdiv(bcpow((-1), $i, $this->scale), bcadd(2*$i, 1, $this->scale), $this->scale);
		}
		$pi = bcmul($div_4, 4, $this->scale);
		return $pi;
	}
	function wallis(){
		if(!$this->k || !$this->scale || $this->k<1 || $this->scale<1){
			throw new Exception("\$k and \$scale must be set!");
		}
		$div_2 = 1;
		for($i=1; $i<=$this->k; $i++){
			$div_2 *= bcdiv(bcmul(4, bcpow($i, 2, $this->scale), $this->scale), bcsub(bcmul(4, bcpow($i, 2, $this->scale), $this->scale), 1, $this->scale), $this->scale);	
		}
		$pi = bcmul($div_2, 2, $this->scale);
		return $pi;
	}
}
?>