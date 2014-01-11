package server;
import haxe.web.Dispatch;
import server.controllers.*;
import server.baz.Controller;

import haxe.macro.Expr.ComplexType;
import haxe.macro.Context;
import haxe.macro.Expr.Field;


//act as config ?
class Routes
{
	public function new()
	{
		
	}

	//TODO generate that with macro !
	function doProject( d:Dispatch ) {
		d.dispatch( new Project() );
	}
	

	function doTest(d:Dispatch){
		d.dispatch( new Test());
	}

	function doApi(d:Dispatch)
	{
		d.dispatch( new Api());
	}

	function doDb(d:Dispatch)
	{
		sys.db.Admin.handler();
	}
	function doFront(d:Dispatch)
	{
		d.dispatch(new Front());
	}

}