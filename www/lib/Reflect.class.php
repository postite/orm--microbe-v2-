<?php

class Reflect {
	public function __construct(){}
	static function field($o, $field) {
		return _hx_field($o, $field);
	}
	static function getProperty($o, $field) {
		if(null === $o) {
			return null;
		}
		$cls = ((Std::is($o, _hx_qtype("Class"))) ? $o->__tname__ : get_class($o));
		$cls_vars = get_class_vars($cls);
		if(isset($cls_vars['__properties__']) && isset($cls_vars['__properties__']['get_'.$field]) && ($field = $cls_vars['__properties__']['get_'.$field])) {
			return $o->$field();
		} else {
			return $o->$field;
		}
	}
	static function setProperty($o, $field, $value) {
		if(null === $o) {
			null;
			return;
		}
		$cls = ((Std::is($o, _hx_qtype("Class"))) ? $o->__tname__ : get_class($o));
		$cls_vars = get_class_vars($cls);
		if(isset($cls_vars['__properties__']) && isset($cls_vars['__properties__']['set_'.$field]) && ($field = $cls_vars['__properties__']['set_'.$field])) {
			$o->$field($value);
			return;
		} else {
			$o->$field = $value;
			return;
		}
	}
	static function callMethod($o, $func, $args) {
		if(is_string($o) && !is_array($func)) {
			return call_user_func_array(Reflect::field($o, $func), $args->a);
		}
		return call_user_func_array(((is_callable($func)) ? $func : array($o, $func)), ((null === $args) ? array() : $args->a));
	}
	static function fields($o) {
		if($o === null) {
			return new _hx_array(array());
		}
		return (($o instanceof _hx_array) ? new _hx_array(array('concat','copy','insert','iterator','length','join','pop','push','remove','reverse','shift','slice','sort','splice','toString','unshift')) : ((is_string($o)) ? new _hx_array(array('charAt','charCodeAt','indexOf','lastIndexOf','length','split','substr','toLowerCase','toString','toUpperCase')) : new _hx_array(_hx_get_object_vars($o))));
	}
	static function isFunction($f) {
		return (is_array($f) && is_callable($f)) || _hx_is_lambda($f) || is_array($f) && _hx_has_field($f[0], $f[1]) && $f[1] !== "length";
	}
	static function compare($a, $b) {
		return (($a == $b) ? 0 : (($a > $b) ? 1 : -1));
	}
	static function deleteField($o, $field) {
		if(!_hx_has_field($o, $field)) {
			return false;
		}
		if(isset($o->__dynamics[$field])) unset($o->__dynamics[$field]); else if($o instanceof _hx_anonymous) unset($o->$f); else $o->$f = null;
		return true;
	}
	function __toString() { return 'Reflect'; }
}
