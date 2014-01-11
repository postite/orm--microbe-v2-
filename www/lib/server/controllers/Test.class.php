<?php

class server_controllers_Test extends server_baz_Controller {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function doEleveursForPets($pet) {
		$pets = vo_Pet::$manager->unsafeObjects("SELECT * FROM pet WHERE type = " . _hx_string_or_null(sys_db_Manager::quoteAny($pet)), null);
		$eleveurs = Lambda::map($pets, array(new _hx_lambda(array(&$pet, &$pets), "server_controllers_Test_0"), 'execute'));
		$farm = new server_FarmView();
		$farm->eleveurs = $eleveurs;
		Sys::hprint($farm->execute());
	}
	public function doBoum($t) {
		haxe_Log::trace("boum" . _hx_string_or_null($t), _hx_anonymous(array("fileName" => "Test.hx", "lineNumber" => 16, "className" => "server.controllers.Test", "methodName" => "doBoum")));
	}
	public function doDefault() {
		haxe_Log::trace("default", _hx_anonymous(array("fileName" => "Test.hx", "lineNumber" => 12, "className" => "server.controllers.Test", "methodName" => "doDefault")));
	}
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	function __toString() { return 'server.controllers.Test'; }
}
server_controllers_Test::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("dispatchConfig" => new _hx_array(array("oy4:boumjy21:haxe.web.DispatchRule:0:1jy18:haxe.web.MatchRule:3:0y7:defaultjR1:1:1ahy15:eleveursForPetsjR1:0:1jR2:3:0g"))))));
function server_controllers_Test_0(&$pet, &$pets, $p) {
	{
		return vo_Eleveur::$manager->unsafeGet($p->eleveurID, null);
	}
}
