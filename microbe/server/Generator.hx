package microbe.server;
import microbe.server.ivo.Spodable;
import sys.db.Manager;
import sys.db.Object;
import vo.Eleveur;
import api.Types;
import vo.Pet;
import vo.Perso;
import microbe.MicroCreator;

import microbe.server.SpodTools;


class Generator
{
	public function new()
	{
		
	}

	public function generate(_vo:String,?id:Int):MicroListe
	{
		//trace( Eleveur.manager.);
		var microbes:MicroListe=null;
		 try{
		 	//populate data
		 	var data:Spodable;
		 	var vo_class= Type.resolveClass("vo."+_vo);
		 	var fullnameClass=Type.getClassName(vo_class);
		 	var manager:Manager<Object>=cast getManager(fullnameClass);
		 	if (id!=null)
		 	data=untyped manager.unsafeGet(id);
		 	else
		 	data=untyped manager.unsafeGet(1);

		 	var tempData= new microbe.SimpleCreator();
		 	tempData._vo=fullnameClass;
		 	 microbes=tempData.create(data);
		 }
		// 	//get formule
			
		// 	var formule:Map<String,Elements>= untyped vo_class.formule;
		// 	var liste:MicroListe= cast {};
		// 	liste.spodinfos= cast {};
		// 	liste.spodinfos.id=data.id;
		// 	liste.spodinfos.behaviour=Simple; // rootSpod
		// 	liste.spodinfos.vo=_vo;
		// 	liste.value= new List();
		// 	//parse formule
		// 	for ( key in formule.keys()){

		// 		var m:MicroField= cast {};
		// 		var form=formule.get(key);
		// 		m.vo=fullnameClass;
		// 		m.id= data.id;  //? 
	
		// 		m.behaviour=form.behaviour;
		// 		m.value=behaviour(m.behaviour,Reflect.getProperty(data,key));
		// 		m.composant=form.composant;
		// 		m.field=key;
		// 		m.litteral=form.litteral;
		// 		liste.value.add(m);
		// 	}
		// return liste;
		// }catch(msg:Dynamic){
		// 	trace( "not formul pour "+_vo+ ":"+msg);
		// }
		 return microbes;
	}


		

		//-----------OUTILS------------à bouger dans spodTools------
        function getManager(_vo:String):Manager<Object>{
                //var manager =  Type.createInstance(
                var t:sys.db.Manager<Object>= Reflect.field(Type.resolveClass(_vo),"manager");
                return t;
                        }
        function getManagerfromClass(cl:Class<Dynamic>)
        {
        	trace( cl);
        	return cast Reflect.field(cl,"manager");
        }
        
        function createInstance(_vo:String) : Object {
                return Type.createInstance(Type.resolveClass(_vo),[]);
        }
}

