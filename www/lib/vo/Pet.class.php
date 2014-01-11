<?php

class vo_Pet extends ufront_db_Object {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function validate() {
		parent::validate();
		if($this->color === null) {
			$this->validationErrors->set("color", "color" . " is a required field.");
		}
		if($this->type === null) {
			$this->validationErrors->set("type", "type" . " is a required field.");
		}
		return !$this->validationErrors->keys()->hasNext();
	}
	public function set_eleveur($v) {
		$this->_eleveur = $v;
		$this->eleveurID = vo_Pet_0($this, $v);
		return $this->_eleveur;
	}
	public function get_eleveur() {
		if($this->_eleveur === null && $this->eleveurID !== null) {
			$this->_eleveur = vo_Eleveur::$manager->unsafeGet($this->eleveurID, null);
		}
		return $this->_eleveur;
	}
	public $_eleveur;
	public $eleveurID;
	public $color;
	public $type;
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
	static $__properties__ = array("set_eleveur" => "set_eleveur","get_eleveur" => "get_eleveur");
	function __toString() { return 'vo.Pet'; }
}
vo_Pet::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => new _hx_array(array("oy4:namey3:pety7:indexesahy9:relationsahy7:hfieldsby2:idoR0R5y6:isNullfy1:tjy17:sys.db.RecordType:2:0gy8:modifiedoR0R9R6fR7jR8:11:0gy9:eleveurIDoR0R10R6tR7jR8:3:0gy4:typeoR0R11R6fR7jR8:9:1i255gy5:coloroR0R12R6fR7jR8:9:1i255gy7:createdoR0R13R6fR7r7ghy3:keyaR5hy6:fieldsar4r14r6r10r12r8hg"))))));
vo_Pet::$manager = new sys_db_Manager(_hx_qtype("vo.Pet"));
vo_Pet::$hxSerializeFields = new _hx_array(array("color", "created", "eleveurID", "id", "modified", "type"));
vo_Pet::$hxRelationships = new _hx_array(array("eleveur,BelongsTo,vo.Eleveur"));
function vo_Pet_0(&$__hx__this, &$v) {
	if($v === null) {
		return null;
	} else {
		return $v->id;
	}
}
