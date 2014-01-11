<?php

class ufront_db__Object_ReadOnlyList_Impl_ {
	public function __construct(){}
	static function get_length($this1) {
		return $this1->length;
	}
	static function first($this1) {
		return $this1->first();
	}
	static function isEmpty($this1) {
		return $this1->isEmpty();
	}
	static function join($this1, $sep) {
		return $this1->join($sep);
	}
	static function last($this1) {
		return $this1->last();
	}
	static function iterator($this1) {
		return $this1->iterator();
	}
	static function filter($this1, $predicate) {
		return $this1->filter($predicate);
	}
	static function map($this1, $fn) {
		return $this1->map($fn);
	}
	static function toString($this1) {
		return $this1->toString();
	}
	static function toArray($this1) {
		return Lambda::harray($this1);
	}
	static $__properties__ = array("get_length" => "get_length");
	function __toString() { return 'ufront.db._Object.ReadOnlyList_Impl_'; }
}
