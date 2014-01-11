<?php

class sys_db_Mysql {
	public function __construct(){}
	static function connect($params) {
		$c = mysql_connect(_hx_string_or_null($params->host) . _hx_string_or_null((sys_db_Mysql_0($params))) . _hx_string_or_null((sys_db_Mysql_1($params))), $params->user, $params->pass);
		if(!mysql_select_db($params->database, $c)) {
			throw new HException("Unable to connect to " . _hx_string_or_null($params->database));
		}
		return new sys_db__Mysql_MysqlConnection($c);
	}
	function __toString() { return 'sys.db.Mysql'; }
}
function sys_db_Mysql_0(&$params) {
	if($params->port === null) {
		return "";
	} else {
		return ":" . _hx_string_rec($params->port, "");
	}
}
function sys_db_Mysql_1(&$params) {
	if($params->socket === null) {
		return "";
	} else {
		return ":" . _hx_string_or_null($params->socket);
	}
}
