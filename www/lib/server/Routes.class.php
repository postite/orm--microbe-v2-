<?php

class server_Routes {
	public function __construct() { 
	}
	public function doTest($d) {
		$d->runtimeDispatch(haxe_web_Dispatch::extractConfig(new server_controllers_Test()));
	}
	public function doProject($d) {
		$d->runtimeDispatch(haxe_web_Dispatch::extractConfig(new server_controllers_Project()));
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'server.Routes'; }
}
server_Routes::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("dispatchConfig" => new _hx_array(array("oy4:testjy21:haxe.web.DispatchRule:0:1jy18:haxe.web.MatchRule:4:0y7:projectjR1:0:1jR2:4:0g"))))));
