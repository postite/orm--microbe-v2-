
package com.postite.microbe.model;

class Model extends mmvc.impl.Actor{


	@:isVar public var message(get,set):String;
	public function new()
	{
		super();

	}
	function set_message(s:String)
	{
		return message= s;
	}
	function get_message()
	{
		return message;
	}


}