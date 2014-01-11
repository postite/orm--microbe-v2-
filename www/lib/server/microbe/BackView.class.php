<?php

class server_microbe_BackView extends erazor_macro_Template {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function execute() {
		$__b__ = new StringBuf();
		{
			$__b__->add("<!DOCTYPE html>\x0A<html>\x0A<head>\x0A\x09<title>back</title>\x0A\x09<script type=\"text/javascript\" src=\"/client.js\"></script>\x0A</head>\x0A<body>\x0A\x0A<div id=\"data\" microbe-data=\"");
			$__b__->add($this->data);
			$__b__->add("\"/>\x0A\x0A</body>\x0A</html>");
		}
		return $__b__->b;
	}
	public $data;
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
	function __toString() { return 'server.microbe.BackView'; }
}
