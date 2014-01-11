<?php

class server_Main {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$this->connect();
		$uri = php_Web::getURI();
		try {
			_hx_deref(new haxe_web_Dispatch($uri, new haxe_ds_StringMap()))->runtimeDispatch(haxe_web_Dispatch::extractConfig(new server_Routes()));
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof haxe_web_DispatchError){
				Sys::hprint("ERROR: " . Std::string($e));
			} else throw $__hx__e;;
		}
	}}
	public function connect() {
		try {
			$cnx = sys_db_Mysql::connect(server_Main::$params);
			sys_db_Manager::set_cnx($cnx);
			sys_db_Manager::initialize();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				throw new HException("pas cool" . Std::string($e));
			}
		}
	}
	public function doDb($d) {
	}
	public function doPetsForEleveurs($_titre) {
		$eleveur = vo_Eleveur::$manager->unsafeObjects("SELECT * FROM eleveur WHERE (titre = " . _hx_string_or_null(sys_db_Manager::quoteAny($_titre)) . ")", null)->first();
		Sys::hprint($eleveur->get_pets()->map(array(new _hx_lambda(array(&$_titre, &$eleveur), "server_Main_0"), 'execute')));
	}
	public function doAll() {
		$p = vo_Eleveur::$manager->all(null);
		if(null == $p) throw new HException('null iterable');
		$__hx__it = $p->iterator();
		while($__hx__it->hasNext()) {
			$a = $__hx__it->next();
			$__hx__it2 = call_user_func((server_Main_1($this, $a, $p, $pet)));
			while($__hx__it2->hasNext()) {
				$pet = $__hx__it2->next();
				Sys::hprint(_hx_string_or_null($a->titre) . "->" . _hx_string_or_null($pet->type));
			}
		}
	}
	public function doRemove($_titre) {
		try {
			$p = vo_Perso::$manager->unsafeObjects("SELECT * FROM perso WHERE (titre = " . _hx_string_or_null(sys_db_Manager::quoteAny($_titre)) . ")", null)->first();
			$p->delete();
			$this->doAll();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				Sys::hprint($msg);
			}
		}
	}
	public function doAddE($titre) {
		$p = new vo_Eleveur();
		$p->titre = $titre;
		try {
			$p->validate();
			$p->save();
			$p = vo_Eleveur::$manager->unsafeObjects("SELECT * FROM eleveur WHERE (titre = " . _hx_string_or_null(sys_db_Manager::quoteAny($p->titre)) . ")", null)->first();
			{
				$_g1 = 0; $_g = Std::random(server_Main::$pets->length);
				while($_g1 < $_g) {
					$a = $_g1++;
					$pet = new vo_Pet();
					$pet->type = server_Main::$pets[$a];
					$pet->set_eleveur($p);
					$pet->save();
					unset($pet,$a);
				}
			}
			$this->doAll();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				Sys::hprint($msg);
			}
		}
	}
	public function doAdd($titre, $pet) {
		$p = new vo_Perso();
		$p->titre = $titre;
		$dog = new vo_Pet();
		$dog->type = $pet;
		$dog->save();
		$p->set_pet($dog);
		try {
			$p->validate();
			$p->save();
			$this->doAll();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$msg = $_ex_;
			{
				Sys::hprint($p->validationErrors->get("titre"));
			}
		}
	}
	public function doInstall() {
		sys_db_TableCreate::create(vo_Pet::$manager, null);
	}
	public function doDefault() {
	}
	static $params;
	static $pets;
	static function main() {
		$app = new server_Main();
	}
	function __toString() { return 'server.Main'; }
}
server_Main::$params = _hx_anonymous(array("user" => "root", "port" => 8889, "pass" => "root", "host" => "localhost", "database" => "orm"));
server_Main::$pets = new _hx_array(array("dog", "vache", "cat", "mouche", "cachalot", "libellule"));
function server_Main_0(&$_titre, &$eleveur, $p) {
	{
		return $p->type;
	}
}
function server_Main_1(&$__hx__this, &$a, &$p, &$pet) {
	{
		$_e = $a->get_pets();
		return array(new _hx_lambda(array(&$_e, &$a, &$p, &$pet), "server_Main_2"), 'execute');
	}
}
function server_Main_2(&$_e, &$a, &$p, &$pet) {
	{
		return $_e->iterator();
	}
}
