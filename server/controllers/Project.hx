package server.controllers;
import microbe.server.Generator;
import vo.Eleveur;
import server.baz.Controller;
import api.Types;
typedef MenuItem={
	link:String,
	label:String
}
class Project extends Controller
{
	var menu:List<MenuItem>;
	public function new()
	{
		super();
		menu=new List();
		var petData:List<Eleveur>= Eleveur.manager.all();
		for (pet in petData)
		menu.add({label:'${pet.titre}',link:'/project/gen/Eleveur/${pet.id}'});
	}
	function doDefault()
	{
		trace( "default");
	}
	function doGen(_vo:String,?id:Int)
	{

		var liste:MicroListe=new Generator().generate(_vo,id);
		trace( "after generate" +liste);
		var view=new BackView();
		view.debug=false;
		#if debug
		view.debug=true;
		#end
		view.menu=menu;
		try{
		//var xListe=haxe.Serializer.run(liste);
		var xListe=microbe.server.SpodSerializer.run(liste);
		view.data=xListe;
		}catch(msg:String){
			trace( "error" + msg);
		}
		Sys.print(view.execute());
	}
}

@:includeTemplate("../../views/back.html")
class BackView extends erazor.macro.Template{
	public var debug:Bool;
	public var menu:List<MenuItem>;
	public var data:String;
}