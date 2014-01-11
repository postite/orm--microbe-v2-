<?php

interface sys_db_Connection {
	function dbName();
	function lastInsertId();
	function addValue($s, $v);
	function request($s);
}
