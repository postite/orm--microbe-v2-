<?php

class ufront_db_Object extends sys_db_Object {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
		$this->validationErrors = new haxe_ds_StringMap();
	}}
	public function hxUnserialize($s) {
		$fields = Type::getClass($this)->hxSerializeFields;
		{
			$_g = 0;
			while($_g < $fields->length) {
				$f = $fields[$_g];
				++$_g;
				if($f === "modified" || $f === "created") {
					$time = $s->unserialize();
					Reflect::setProperty($this, $f, (($time !== null) ? Date::fromTime($time) : Date::now()));
					unset($time);
				} else {
					if(StringTools::startsWith($f, "ManyToMany")) {
						$bName = $s->unserialize();
						$bListIDs = $s->unserialize();
						if($bName !== null) {
							$b = Type::resolveClass($bName);
							if($bListIDs === null) {
								$bListIDs = new HList();
							}
							$m2m = new ufront_db_ManyToMany($this, $b, null);
							$m2m->bListIDs = $bListIDs;
							$m2m->bList = null;
							$this->{"_" . _hx_string_or_null(_hx_substr($f, 10, null))} = $m2m;
							unset($m2m,$b);
						}
						unset($bName,$bListIDs);
					} else {
						Reflect::setProperty($this, $f, $s->unserialize());
					}
				}
				unset($f);
			}
		}
	}
	public function hxSerialize($s) {
		$s->useEnumIndex = true;
		$s->useCache = false;
		$fields = Type::getClass($this)->hxSerializeFields;
		{
			$_g = 0;
			while($_g < $fields->length) {
				$f = $fields[$_g];
				++$_g;
				if($f === "modified" || $f === "created") {
					$date = Reflect::field($this, $f);
					$s->serialize((($date !== null) ? $date->getTime() : null));
					unset($date);
				} else {
					if(StringTools::startsWith($f, "ManyToMany")) {
						$m2m = Reflect::getProperty($this, "_" . _hx_string_or_null(_hx_substr($f, 10, null)));
						if($m2m !== null) {
							$s->serialize(Type::getClassName($m2m->b));
							$s->serialize($m2m->bListIDs);
						} else {
							$relArr = Type::getClass($this)->hxRelationships;
							$fieldName = _hx_substr($f, 10, null);
							$relEntry = _hx_array_get($relArr->filter(array(new _hx_lambda(array(&$_g, &$f, &$fieldName, &$fields, &$m2m, &$relArr, &$s), "ufront_db_Object_0"), 'execute')), 0);
							$typeName = _hx_explode(",", $relEntry)->pop();
							$s->serialize($typeName);
							$s->serialize(null);
							unset($typeName,$relEntry,$relArr,$fieldName);
						}
						unset($m2m);
					} else {
						$s->serialize(Reflect::getProperty($this, $f));
					}
				}
				unset($f);
			}
		}
	}
	public function checkAuthWrite() {
		return true;
	}
	public function checkAuthRead() {
		return true;
	}
	public function validate() {
		$this->validationErrors = new haxe_ds_StringMap();
		return !$this->validationErrors->keys()->hasNext();
	}
	public $validationErrors;
	public function save() {
		if($this->id === null) {
			$this->insert();
		} else {
			try {
				$this->_lock = true;
				$this->update();
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				$e = $_ex_;
				{
					if(_hx_index_of(Std::string($e), "Data validation failed", null) !== -1) {
						throw new HException($e);
					}
					$this->insert();
				}
			}
		}
	}
	public function update() {
		if($this->validate()) {
			if($this->checkAuthWrite()) {
				$this->modified = Date::now();
				parent::update();
			} else {
				throw new HException("You do not have permission to save object " . Std::string($this));
			}
		} else {
			$errors = Lambda::harray($this->validationErrors)->join(", ");
			throw new HException("Data validation failed for " . Std::string($this) . ": " . _hx_string_or_null($errors));
		}
	}
	public function insert() {
		if($this->validate()) {
			if($this->checkAuthWrite()) {
				$this->created = Date::now();
				$this->modified = Date::now();
				parent::insert();
			} else {
				throw new HException("You do not have permission to save object " . Std::string($this));
			}
		} else {
			$errors = Lambda::harray($this->validationErrors)->join("\x0A");
			throw new HException("Data validation failed for " . Std::string($this) . ": \x0A" . _hx_string_or_null($errors));
		}
	}
	public $modified;
	public $created;
	public $id;
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
	static $hxSerializeFields;
	static $manager;
	function __toString() { return 'ufront.db.Object'; }
}
ufront_db_Object::$__meta__ = _hx_anonymous(array("obj" => _hx_anonymous(array("rtti" => new _hx_array(array("oy4:namey6:Objecty7:indexesahy9:relationsahy7:hfieldsby2:idoR0R5y6:isNullfy1:tjy17:sys.db.RecordType:2:0gy8:modifiedoR0R9R6fR7jR8:11:0gy7:createdoR0R10R6fR7r7ghy3:keyaR5hy6:fieldsar4r8r6hg")), "noTable" => null))));
ufront_db_Object::$hxSerializeFields = new _hx_array(array("id", "created", "modified"));
ufront_db_Object::$manager = new sys_db_Manager(_hx_qtype("ufront.db.Object"));
function ufront_db_Object_0(&$_g, &$f, &$fieldName, &$fields, &$m2m, &$relArr, &$s, $r) {
	{
		return StringTools::startsWith($r, _hx_string_or_null($fieldName) . ",");
	}
}
