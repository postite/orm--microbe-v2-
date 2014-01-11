<?php

class ufront_db_ManyToMany {
	public function __construct($aObject, $bClass, $initialise = null) {
		if(!php_Boot::$skip_constructor) {
		if($initialise === null) {
			$initialise = true;
		}
		$this->aObject = $aObject;
		$this->a = Type::getClass($aObject);
		$this->b = $bClass;
		$this->bManager = $this->b->manager;
		$this->tableName = ufront_db_ManyToMany::generateTableName($this->a, $this->b);
		$this->manager = ufront_db_ManyToMany::getManager($this->tableName);
		if($initialise) {
			$this->refreshList();
		}
	}}
	public function get_length() {
		return $this->bList->length;
	}
	public function push($bObject) {
		$this->add($bObject);
	}
	public function pop() {
		$bObject = $this->bList->pop();
		if($bObject !== null && $this->aObject !== null) {
			$aColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r1" : "r2");
			$bColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r2" : "r1");
			$this->manager->unsafeDelete("DELETE FROM `" . _hx_string_or_null($this->tableName) . "` WHERE " . _hx_string_or_null($aColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($this->aObject->id)) . " AND " . _hx_string_or_null($bColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($bObject->id)));
		}
		return $bObject;
	}
	public function iterator() {
		return $this->bList->iterator();
	}
	public function setList($newBList) {
		if(null == $this->bList) throw new HException('null iterable');
		$__hx__it = $this->bList->iterator();
		while($__hx__it->hasNext()) {
			$oldB = $__hx__it->next();
			if(Lambda::has($newBList, $oldB) === false) {
				$this->remove($oldB);
			}
		}
		if(null == $newBList) throw new HException('null iterable');
		$__hx__it = $newBList->iterator();
		while($__hx__it->hasNext()) {
			$b = $__hx__it->next();
			$this->add($b);
		}
	}
	public function clear() {
		$this->bList->clear();
		if($this->aObject !== null) {
			$aColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r1" : "r2");
			$this->manager->unsafeDelete("DELETE FROM `" . _hx_string_or_null($this->tableName) . "` WHERE " . _hx_string_or_null($aColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($this->aObject->id)));
		}
	}
	public function remove($bObject) {
		if($bObject !== null) {
			$this->bList->remove($bObject);
			$aColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r1" : "r2");
			$bColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r2" : "r1");
			$this->manager->unsafeDelete("DELETE FROM `" . _hx_string_or_null($this->tableName) . "` WHERE " . _hx_string_or_null($aColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($this->aObject->id)) . " AND " . _hx_string_or_null($bColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($bObject->id)));
		}
	}
	public function add($bObject) {
		if($bObject !== null && Lambda::has($this->bList, $bObject) === false) {
			$this->bList->add($bObject);
			if($bObject->id === null) {
				$bObject->insert();
			}
			$r = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? new ufront_db_Relationship($this->aObject->id, $bObject->id) : new ufront_db_Relationship($bObject->id, $this->aObject->id));
			$r->insert();
		}
	}
	public function first() {
		return $this->bList->first();
	}
	public function refreshList() {
		if($this->aObject !== null) {
			$id = $this->aObject->id;
			$aColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r1" : "r2");
			$bColumn = ((ufront_db_ManyToMany::isABeforeB($this->a, $this->b)) ? "r2" : "r1");
			$relationships = $this->manager->unsafeObjects("SELECT * FROM `" . _hx_string_or_null($this->tableName) . "` WHERE " . _hx_string_or_null($aColumn) . " = " . _hx_string_or_null(sys_db_Manager::quoteAny($id)), false);
			if($relationships->length > 0) {
				$this->bListIDs = $relationships->map(array(new _hx_lambda(array(&$aColumn, &$bColumn, &$id, &$relationships), "ufront_db_ManyToMany_0"), 'execute'));
				$this->bList = $this->bManager->unsafeObjects("SELECT * FROM `" . _hx_string_or_null($this->bManager->table_name) . "` WHERE " . _hx_string_or_null(sys_db_Manager::quoteList("id", $this->bListIDs)), false);
			}
		}
		if($this->bList === null) {
			$this->bList = new HList();
		}
		if($this->bListIDs === null) {
			$this->bListIDs = new HList();
		}
	}
	public $manager;
	public $bManager;
	public $tableName;
	public $length;
	public $bListIDs;
	public $bList;
	public $aObject;
	public $b;
	public $a;
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
	static $managers;
	static function getManager($tableName) {
		$m = null;
		if(ufront_db_ManyToMany::$managers->exists($tableName)) {
			$m = ufront_db_ManyToMany::$managers->get($tableName);
		} else {
			$m = new sys_db_Manager(_hx_qtype("ufront.db.Relationship"));
			$m->table_name = $tableName;
			ufront_db_ManyToMany::$managers->set($tableName, $m);
		}
		return $m;
	}
	static function isABeforeB($a, $b) {
		$aName = _hx_explode(".", Type::getClassName($a))->pop();
		$bName = _hx_explode(".", Type::getClassName($b))->pop();
		$arr = new _hx_array(array($aName, $bName));
		$arr->sort(array(new _hx_lambda(array(&$a, &$aName, &$arr, &$b, &$bName), "ufront_db_ManyToMany_1"), 'execute'));
		return $arr[0] === $aName;
	}
	static function generateTableName($a, $b) {
		$aName = _hx_explode(".", Type::getClassName($a))->pop();
		$bName = _hx_explode(".", Type::getClassName($b))->pop();
		$arr = new _hx_array(array($aName, $bName));
		$arr->sort(array(new _hx_lambda(array(&$a, &$aName, &$arr, &$b, &$bName), "ufront_db_ManyToMany_2"), 'execute'));
		$arr->unshift("_join");
		return $arr->join("_");
	}
	static function relatedIDsforObjects($aModel, $bModel, $aObjectIDs = null) {
		$aBeforeB = ufront_db_ManyToMany::isABeforeB($aModel, $bModel);
		$tableName = ufront_db_ManyToMany::generateTableName($aModel, $bModel);
		$manager = ufront_db_ManyToMany::getManager($tableName);
		$aColumn = (($aBeforeB) ? "r1" : "r2");
		$relationships = null;
		if($aObjectIDs === null) {
			$relationships = $manager->all(null);
		} else {
			$relationships = $manager->unsafeObjects("SELECT * FROM `" . _hx_string_or_null($tableName) . "` WHERE " . _hx_string_or_null(sys_db_Manager::quoteList($aColumn, $aObjectIDs)), false);
		}
		$intMap = new haxe_ds_IntMap();
		if(null == $relationships) throw new HException('null iterable');
		$__hx__it = $relationships->iterator();
		while($__hx__it->hasNext()) {
			$r = $__hx__it->next();
			$aID = ufront_db_ManyToMany_3($aBeforeB, $aColumn, $aModel, $aObjectIDs, $bModel, $intMap, $manager, $r, $relationships, $tableName);
			$bID = ufront_db_ManyToMany_4($aBeforeB, $aColumn, $aID, $aModel, $aObjectIDs, $bModel, $intMap, $manager, $r, $relationships, $tableName);
			$list = $intMap->get($aID);
			if($list === null) {
				$intMap->set($aID, $list = new HList());
			}
			$list->push($bID);
			unset($list,$bID,$aID);
		}
		return $intMap;
	}
	static $__properties__ = array("get_length" => "get_length");
	function __toString() { return 'ufront.db.ManyToMany'; }
}
ufront_db_ManyToMany::$managers = new haxe_ds_StringMap();
function ufront_db_ManyToMany_0(&$aColumn, &$bColumn, &$id, &$relationships, $r) {
	{
		return Reflect::field($r, $bColumn);
	}
}
function ufront_db_ManyToMany_1(&$a, &$aName, &$arr, &$b, &$bName, $x, $y) {
	{
		return Reflect::compare($x, $y);
	}
}
function ufront_db_ManyToMany_2(&$a, &$aName, &$arr, &$b, &$bName, $x, $y) {
	{
		return Reflect::compare($x, $y);
	}
}
function ufront_db_ManyToMany_3(&$aBeforeB, &$aColumn, &$aModel, &$aObjectIDs, &$bModel, &$intMap, &$manager, &$r, &$relationships, &$tableName) {
	if($aBeforeB) {
		return $r->r1;
	} else {
		return $r->r2;
	}
}
function ufront_db_ManyToMany_4(&$aBeforeB, &$aColumn, &$aID, &$aModel, &$aObjectIDs, &$bModel, &$intMap, &$manager, &$r, &$relationships, &$tableName) {
	if($aBeforeB) {
		return $r->r2;
	} else {
		return $r->r1;
	}
}
