<?php

class sys_db__Mysql_MysqlResultSet implements sys_db_ResultSet{
	public function __construct($r, $c) {
		if(!php_Boot::$skip_constructor) {
		$this->__r = $r;
		$this->__c = $c;
	}}
	public function results() {
		$l = new HList();
		while($this->hasNext()) {
			$l->add($this->next());
		}
		return $l;
	}
	public function next() {
		if(_hx_field($this, "cache") !== null) {
			$t = $this->cache;
			$this->cache = null;
			return $t;
		}
		if(!$this->fetchRow()) {
			return null;
		}
		$o = _hx_anonymous(array());
		$descriptions = $this->getFieldsDescription();
		{
			$_g1 = 0; $_g = $this->get_nfields();
			while($_g1 < $_g) {
				$i = $_g1++;
				$o->{_hx_array_get($descriptions, $i)->name} = $this->convert($this->cRow[$i], _hx_array_get($descriptions, $i)->type);
				unset($i);
			}
		}
		return $o;
	}
	public function fetchRow() {
		$this->cRow = mysql_fetch_array($this->__r, MYSQL_NUM);
		return !($this->cRow === false);
	}
	public $cRow;
	public function hasNext() {
		if(_hx_field($this, "cache") === null) {
			$this->cache = $this->next();
		}
		return _hx_field($this, "cache") !== null;
	}
	public function convert($v, $type) {
		if($v === null) {
			return $v;
		}
		switch($type) {
		case "int":case "year":{
			return intval($v);
		}break;
		case "real":{
			return floatval($v);
		}break;
		case "datetime":case "date":{
			return Date::fromString($v);
		}break;
		case "blob":{
			return haxe_io_Bytes::ofData($v);
		}break;
		default:{
			return $v;
		}break;
		}
	}
	public function getFieldsDescription() {
		if($this->_fieldsDesc === null) {
			$this->_fieldsDesc = new _hx_array(array());
			{
				$_g1 = 0; $_g = $this->get_nfields();
				while($_g1 < $_g) {
					$i = $_g1++;
					$item = _hx_anonymous(array("name" => mysql_field_name($this->__r, $i), "type" => mysql_field_type($this->__r, $i)));
					$this->_fieldsDesc->push($item);
					unset($item,$i);
				}
			}
		}
		return $this->_fieldsDesc;
	}
	public $_fieldsDesc;
	public function get_nfields() {
		if($this->_nfields === null) {
			$this->_nfields = mysql_num_fields($this->__r);
		}
		return $this->_nfields;
	}
	public $_nfields;
	public $cache;
	public $__c;
	public $__r;
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
	function __toString() { return 'sys.db._Mysql.MysqlResultSet'; }
}
