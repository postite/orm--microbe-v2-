package server.controllers;

import api.Types;
import server.baz.Controller;
import sys.db.Manager;
import sys.db.Object;

import neko.Web;

import vo.Pet;
import vo.Eleveur;

class Api extends Controller
{
	public function new()
	{
		super();
	}
	function doDefault()
	{
		trace( "default");

	
	}
	///utils 
	function getManager(_vo:String):Manager<Object>{
                
                //var manager =  Type.createInstance(
                var t:sys.db.Manager<Object>= Reflect.field(Type.resolveClass(_vo),"manager");
                
                return t;
    }



    /// CRUD

    function doCreate(_vo:String)
    {
   		var inst:Object=microbe.server.SpodTools.createInstance(_vo);
   		cast (inst).save();
    }



	function doRec()
	{

		var postParams= Web.getPostData();
		var liste:List<MicroField>=cast haxe.Unserializer.run(postParams);
		//
		//Sys.print(session);
		var ex:MicroField= liste.first();
		trace( "ex=");
		var _vo=ex.vo;
		trace( "vo="+_vo);
		var manager= getManager(_vo);
		try{
			var spod=untyped manager.unsafeGet(ex.id);
			Reflect.setProperty(spod,ex.field,ex.value);
			untyped spod.save();
			return Sys.print("cool");
		}catch(msg:Dynamic){
			trace( "erreur"+msg);
		}
		return Sys.print("pas cool");
	}



	function inspectMicroField()
	{
		
	}
}