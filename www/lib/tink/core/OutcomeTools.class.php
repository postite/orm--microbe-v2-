<?php

class tink_core_OutcomeTools {
	public function __construct(){}
	static function sure($outcome) {
		return tink_core_OutcomeTools_0($outcome);
	}
	static function toOption($outcome) {
		return tink_core_OutcomeTools_1($outcome);
	}
	static function toOutcome($option, $pos = null) {
		return tink_core_OutcomeTools_2($option, $pos);
	}
	static function orUse($outcome, $fallback) {
		return tink_core_OutcomeTools_3($fallback, $outcome);
	}
	static function orTry($outcome, $fallback) {
		return tink_core_OutcomeTools_4($fallback, $outcome);
	}
	static function equals($outcome, $to) {
		return tink_core_OutcomeTools_5($outcome, $to);
	}
	static function map($outcome, $transform) {
		return tink_core_OutcomeTools_6($outcome, $transform);
	}
	static function isSuccess($outcome) {
		return tink_core_OutcomeTools_7($outcome);
	}
	function __toString() { return 'tink.core.OutcomeTools'; }
}
function tink_core_OutcomeTools_0(&$outcome) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	$data = $__hx__t->params[0];
	{
		return $data;
	}break;
	case 1:
	$failure = $__hx__t->params[0];
	{
		if(Std::is($failure, _hx_qtype("tink.core.Error"))) {
			return $failure->throwSelf();
		} else {
			throw new HException($failure);
		}
	}break;
	}
}
function tink_core_OutcomeTools_1(&$outcome) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	$data = $__hx__t->params[0];
	{
		return haxe_ds_Option::Some($data);
	}break;
	case 1:
	{
		return haxe_ds_Option::$None;
	}break;
	}
}
function tink_core_OutcomeTools_2(&$option, &$pos) {
	$__hx__t = ($option);
	switch($__hx__t->index) {
	case 0:
	$value = $__hx__t->params[0];
	{
		return tink_core_Outcome::Success($value);
	}break;
	case 1:
	{
		return tink_core_Outcome::Failure("Some value expected but none found in " . _hx_string_or_null($pos->fileName) . "@line " . _hx_string_rec($pos->lineNumber, ""));
	}break;
	}
}
function tink_core_OutcomeTools_3(&$fallback, &$outcome) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	$data = $__hx__t->params[0];
	{
		return $data;
	}break;
	case 1:
	{
		return $fallback;
	}break;
	}
}
function tink_core_OutcomeTools_4(&$fallback, &$outcome) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	{
		return $outcome;
	}break;
	case 1:
	{
		return $fallback;
	}break;
	}
}
function tink_core_OutcomeTools_5(&$outcome, &$to) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	$data = $__hx__t->params[0];
	{
		return $data == $to;
	}break;
	case 1:
	{
		return false;
	}break;
	}
}
function tink_core_OutcomeTools_6(&$outcome, &$transform) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	$a = $__hx__t->params[0];
	{
		return tink_core_Outcome::Success(call_user_func_array($transform, array($a)));
	}break;
	case 1:
	$f = $__hx__t->params[0];
	{
		return tink_core_Outcome::Failure($f);
	}break;
	}
}
function tink_core_OutcomeTools_7(&$outcome) {
	$__hx__t = ($outcome);
	switch($__hx__t->index) {
	case 0:
	{
		return true;
	}break;
	default:{
		return false;
	}break;
	}
}
