<?php

class php_Lib {
	public function __construct(){}
	static function isCli() {
		return (0 == strncasecmp(PHP_SAPI, 'cli', 3));
	}
	function __toString() { return 'php.Lib'; }
}
