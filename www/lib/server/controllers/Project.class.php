<?php

class server_controllers_Project extends server_baz_Controller {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function doGen($_vo) {
		_hx_deref(new server_microbe_FormGenerator())->generate($_vo);
	}
	public function doDefault() {
		haxe_Log::trace("default", _hx_anonymous(array("fileName" => "Project.hx", "lineNumber" => 12, "className" => "server.controllers.Project", "methodName" => "doDefault")));
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'server.controllers.Project'; }
}
server_controllers_Project::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("dispatchConfig" => new _hx_array(array("oy3:genjy21:haxe.web.DispatchRule:0:1jy18:haxe.web.MatchRule:3:0y7:defaultjR1:1:1ahg"))))));
