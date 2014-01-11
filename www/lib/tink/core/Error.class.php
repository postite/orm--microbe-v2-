<?php

class tink_core_Error {
	public function __construct($message, $pos = null) {
		if(!php_Boot::$skip_constructor) {
		$this->message = $message;
		$this->pos = $pos;
	}}
	public function throwSelf() {
		tink_core_Error_0($this);
	}
	public function toString() {
		$ret = "Error: " . _hx_string_or_null($this->message);
		if(_hx_field($this, "pos") !== null) {
			$ret .= _hx_string_or_null($this->printPos());
		}
		return $ret;
	}
	public function printPos() {
		return _hx_string_or_null($this->pos->className) . "." . _hx_string_or_null($this->pos->methodName) . ":" . _hx_string_rec($this->pos->lineNumber, "");
	}
	public $pos;
	public $data;
	public $message;
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
	static function withData($message, $data, $pos = null) {
		$ret = new tink_core_Error($message, $pos);
		$ret->data = $data;
		return $ret;
	}
	function __toString() { return $this->toString(); }
}
function tink_core_Error_0(&$__hx__this) {
	throw new HException($__hx__this);
}
