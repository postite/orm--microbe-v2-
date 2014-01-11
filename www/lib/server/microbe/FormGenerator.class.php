<?php

class server_microbe_FormGenerator {
	public function __construct() { 
	}
	public function generate($_vo) {
		$inst = Type::resolveClass("vo." . _hx_string_or_null($_vo));
		$formule = $inst->formule;
		$liste = new HList();
		if(null == $formule) throw new HException('null iterable');
		$__hx__it = $formule->keys();
		while($__hx__it->hasNext()) {
			$key = $__hx__it->next();
			$m = _hx_anonymous(array());
			$form = $formule->get($key);
			$m->vo = $_vo;
			$m->value = "lkl";
			$m->behaviour = $form->behaviour;
			$m->champs = $form->litteral;
			$liste->add($m);
			unset($m,$form);
		}
		$view = new server_microbe_BackView();
		$view->data = haxe_Serializer::run($liste);
		Sys::hprint($view->execute());
	}
	function __toString() { return 'server.microbe.FormGenerator'; }
}
