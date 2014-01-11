package server.controllers;
import server.baz.Controller;
import Sys.*;
class Front extends Controller
{
	public function new()
	{	
		super();
	}

	function doDefault()
	{
		
		var view=new FrontView();
		view.data="plok";
		view.include=include;
		view.includeExt=includeExt;
		print(view.execute());
	}

	public function include():String
	{
		var sub=new Sub();
		sub.data="tip";
		return sub.execute();
	}


	///mmm marche pas !
	public function includeExt(view:String):String
	{
		var t:erazor.Template= new erazor.Template(sys.io.File.getContent(view));
		return t.execute({data:"bim"});
	}
}

@:includeTemplate("../../views/front.html")
class FrontView extends erazor.macro.Template{
	public var includeExt:String->String;
	public var include:Void->String;
	public var menu:String;
	public var data:String;
}

@template('
<div class="pop">@data</div>
	')
class Sub extends erazor.macro.Template{
public var data:String;
}
