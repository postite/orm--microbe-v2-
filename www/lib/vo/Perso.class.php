<?php

class vo_Perso extends ufront_db_Object {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function validate_titre() {
		if(!(strlen($this->titre) > 6)) {
			$this->validationErrors->set("titre", "titre must be at least 6 characters long");
		}
	}
	public function validate() {
		parent::validate();
		$this->validate_titre();
		if($this->petID === null) {
			$this->validationErrors->set("petID", "petID" . " is a required field.");
		}
		if($this->genre === null) {
			$this->validationErrors->set("genre", "genre" . " is a required field.");
		}
		if($this->titre === null) {
			$this->validationErrors->set("titre", "titre" . " is a required field.");
		}
		return !$this->validationErrors->keys()->hasNext();
	}
	public function set_pet($v) {
		$this->_pet = $v;
		if($v === null) {
			throw new HException("Pet cannot be null");
		}
		$this->petID = $v->id;
		return $this->_pet;
	}
	public function get_pet() {
		if($this->_pet === null && $this->petID !== null) {
			$this->_pet = vo_Pet::$manager->unsafeGet($this->petID, null);
		}
		return $this->_pet;
	}
	public $_pet;
	public $petID;
	public $genre;
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
	static $manager;
	static $hxSerializeFields;
	static $hxRelationships;
	static $__properties__ = array("set_pet" => "set_pet","get_pet" => "get_pet");
	function __toString() { return 'vo.Perso'; }
}
vo_Perso::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => new _hx_array(array("oy4:namey5:persoy7:indexesahy9:relationsahy7:hfieldsby5:petIDoR0R5y6:isNullfy1:tjy17:sys.db.RecordType:3:0gy2:idoR0R9R6fR7jR8:2:0gy5:genreoR0R10R6fR7jR8:9:1i255gy8:modifiedoR0R11R6fR7jR8:11:0gy5:titreoR0R12R6fR7jR8:9:1i255gy7:createdoR0R13R6fR7r11ghy3:keyaR9hy6:fieldsar6r14r10r12r8r4hg"))))));
vo_Perso::$manager = new sys_db_Manager(_hx_qtype("vo.Perso"));
vo_Perso::$hxSerializeFields = new _hx_array(array("created", "genre", "id", "modified", "petID", "titre"));
vo_Perso::$hxRelationships = new _hx_array(array("pet,BelongsTo,vo.Pet"));
