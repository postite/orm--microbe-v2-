<?php

class server_FarmView extends erazor_macro_Template {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function execute() {
		$__b__ = new StringBuf();
		{
			$__b__->add("<div>\x0A\x09<link rel='stylesheet' href='/style.css' />\x0A\x09");
			if(null == $this->eleveurs) throw new HException('null iterable');
			$__hx__it = $this->eleveurs->iterator();
			while($__hx__it->hasNext()) {
				$eleveur = $__hx__it->next();
				$__b__->add("\x0A\x09\x09<p class='elev'>");
				$__b__->add($eleveur->titre);
				$__b__->add("</p>\x0A\x09\x09");
				$__hx__it2 = call_user_func((server_FarmView_0($this, $__b__, $eleveur, $pet)));
				while($__hx__it2->hasNext()) {
					$pet = $__hx__it2->next();
					$__b__->add("\x0A\x09\x09\x09<span class='pet'>");
					$__b__->add($pet->type);
					$__b__->add("</span>\x0A\x09\x09");
					null;
				}
				$__b__->add("\x0A\x09");
				null;
			}
			$__b__->add("\x0A\x0A\x0A\x09</div>");
		}
		return $__b__->b;
	}
	public $animaux;
	public $eleveurs;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'server.FarmView'; }
}
function server_FarmView_0(&$__hx__this, &$__b__, &$eleveur, &$pet) {
	{
		$_e = $eleveur->get_pets();
		return array(new _hx_lambda(array(&$__b__, &$_e, &$eleveur, &$pet), "server_FarmView_1"), 'execute');
	}
}
function server_FarmView_1(&$__b__, &$_e, &$eleveur, &$pet) {
	{
		return $_e->iterator();
	}
}
