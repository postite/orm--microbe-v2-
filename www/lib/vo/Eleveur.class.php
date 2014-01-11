<?php

class vo_Eleveur extends ufront_db_Object {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function validate() {
		parent::validate();
		if($this->titre === null) {
			$this->validationErrors->set("titre", "titre" . " is a required field.");
		}
		return !$this->validationErrors->keys()->hasNext();
	}
	public function get_pets() {
		$s = $this;
		if($this->_pets === null) {
			$quotedID = sys_db_Manager::quoteAny($s->id);
			$table = vo_Pet::$manager->table_name;
			$this->_pets = vo_Pet::$manager->unsafeObjects("SELECT * FROM " . _hx_string_or_null($table) . " WHERE eleveurID = " . _hx_string_or_null($quotedID), null);
		}
		return $this->_pets;
	}
	public $_pets;
	public $pets;
	public $titre;
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
	static function __meta__() { $args = func_get_args(); return call_user_func_array(self::$__meta__, $args); }
	static $__meta__;
	static $formule;
	static $manager;
	static $hxSerializeFields;
	static $hxRelationships;
	static $__properties__ = array("get_pets" => "get_pets");
	function __toString() { return 'vo.Eleveur'; }
}
vo_Eleveur::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => new _hx_array(array("oy4:namey7:eleveury7:indexesahy9:relationsahy7:hfieldsby2:idoR0R5y6:isNullfy1:tjy17:sys.db.RecordType:2:0gy8:modifiedoR0R9R6fR7jR8:11:0gy5:titreoR0R10R6fR7jR8:9:1i255gy7:createdoR0R11R6fR7r7ghy3:keyaR5hy6:fieldsar4r10r6r8hg"))))));
vo_Eleveur::$formule = vo_Eleveur_0();
vo_Eleveur::$manager = new sys_db_Manager(_hx_qtype("vo.Eleveur"));
vo_Eleveur::$hxSerializeFields = new _hx_array(array("created", "id", "modified", "titre"));
vo_Eleveur::$hxRelationships = new _hx_array(array("pets,HasMany,vo.Pet,eleveurID"));
function vo_Eleveur_0() {
	{
		$_g = new haxe_ds_StringMap();
		$_g->set("titre", _hx_anonymous(array("litteral" => "un", "composant" => "microbe", "behaviour" => "normal")));
		$_g->set("pets", _hx_anonymous(array("litteral" => "animaux", "composant" => "microbe", "behaviour" => "collec")));
		return $_g;
	}
}
