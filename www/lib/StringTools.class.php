<?php

class StringTools {
	public function __construct(){}
	static function startsWith($s, $start) {
		return strlen($s) >= strlen($start) && _hx_substr($s, 0, strlen($start)) === $start;
	}
	function __toString() { return 'StringTools'; }
}
