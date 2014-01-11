<?php

class Main {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$this->connect();
	}}
	public function connect() {
		try {
			$cnx = sys_db_Mysql::connect(Main::$params);
			sys_db_Manager::set_cnx($cnx);
			sys_db_Manager::initialize();
			$uri = php_Web::getURI();
			_hx_deref(new haxe_web_Dispatch($uri, php_Web::getParams()))->runtimeDispatch(haxe_web_Dispatch::extractConfig($this));
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
		Sys::hprint($eleveur->get_pets()->map(array(new _hx_lambda(array(&$_titre, &$eleveur), "Main_0"), 'execute')));
	}
	public function doEleveursForPets($pet) {
		$pets = vo_Pet::$manager->unsafeObjects("SELECT * FROM pet WHERE type = " . _hx_string_or_null(sys_db_Manager::quoteAny($pet)), null);
		$eleveurs = Lambda::map($pets, array(new _hx_lambda(array(&$pet, &$pets), "Main_1"), 'execute'));
		$farm = new FarmView();
		$farm->eleveurs = $eleveurs;
		Sys::hprint($farm->execute());
	}
	public function doAll() {
		$p = vo_Eleveur::$manager->all(null);
		if(null == $p) throw new HException('null iterable');
		$__hx__it = $p->iterator();
		while($__hx__it->hasNext()) {
			$a = $__hx__it->next();
			$__hx__it2 = call_user_func((Main_2($this, $a, $p, $pet)));
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
				$_g1 = 0; $_g = Std::random(Main::$pets->length);
				while($_g1 < $_g) {
					$a = $_g1++;
					$pet = new vo_Pet();
					$pet->type = Main::$pets[$a];
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
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static $params;
	static $pets;
	static function main() {
		$app = new Main();
	}
	function __toString() { return 'Main'; }
}
Main::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("dispatchConfig" => new _hx_array(array("oy4:addEjy21:haxe.web.DispatchRule:0:1jy18:haxe.web.MatchRule:3:0y2:dbjR1:0:1jR2:4:0y3:addjR1:1:1ajR2:3:0jR2:3:0hy3:alljR1:1:1ahy6:removejR1:0:1jR2:3:0y7:installjR1:1:1ahy7:defaultjR1:1:1ahy15:eleveursForPetsjR1:0:1jR2:3:0y15:petsForEleveursjR1:0:1jR2:3:0g"))))));
Main::$params = _hx_anonymous(array("user" => "root", "port" => 8889, "pass" => "root", "host" => "localhost", "database" => "orm"));
Main::$pets = new _hx_array(array("dog", "vache", "cat", "mouche", "cachalot", "libellule"));
function Main_0(&$_titre, &$eleveur, $p) {
	{
		return $p->type;
	}
}
function Main_1(&$pet, &$pets, $p) {
	{
		return vo_Eleveur::$manager->unsafeGet($p->eleveurID, null);
	}
}
function Main_2(&$__hx__this, &$a, &$p, &$pet) {
	{
		$_e = $a->get_pets();
		return array(new _hx_lambda(array(&$_e, &$a, &$p, &$pet), "Main_3"), 'execute');
	}
}
function Main_3(&$_e, &$a, &$p, &$pet) {
	{
		return $_e->iterator();
	}
}
