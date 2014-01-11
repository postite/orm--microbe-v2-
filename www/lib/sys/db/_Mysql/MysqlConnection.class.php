<?php

class sys_db__Mysql_MysqlConnection implements sys_db_Connection{
	public function __construct($c) {
		if(!php_Boot::$skip_constructor) {
		$this->c = $c;
	}}
	public function dbName() {
		return "MySQL";
	}
	public function lastInsertId() {
		return mysql_insert_id($this->c);
	}
	public function addValue($s, $v) {
		if(is_int($v) || is_null($v)) {
			$s->add($v);
		} else {
			if(is_bool($v)) {
				$s->add((($v) ? 1 : 0));
			} else {
				$s->add($this->quote(Std::string($v)));
			}
		}
	}
	public function quote($s) {
		return "'" . _hx_string_or_null((_hx_string_or_null(mysql_real_escape_string($s, $this->c)) . "'"));
	}
	public function request($s) {
		$h = mysql_query($s, $this->c);
		if(($h === false)) {
			throw new HException("Error while executing " . _hx_string_or_null($s) . " (" . _hx_string_or_null((_hx_string_or_null(mysql_error($this->c)) . ")")));
		}
		return new sys_db__Mysql_MysqlResultSet($h, $this->c);
	}
	public $c;
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
	function __toString() { return 'sys.db._Mysql.MysqlConnection'; }
}
