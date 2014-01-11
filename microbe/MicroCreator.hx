package microbe;
import api.Types;
import microbe.server.ivo.Spodable;
interface IMicroCreator{
	public function create(data:Dynamic):Dynamic;
}


//server Side
//@todo merge creator&behaviour(parser) ?

class SimpleCreator implements IMicroCreator{
public var _vo:String;
public function new()
{
	
}
	public function create(data:Dynamic):Dynamic
	{

		try{
			//populate data
			// var data:Spodable;
			
			// 
			// var manager:Manager<Object>=cast getManager(fullnameClass);
			// if (id!=null)
			// data=untyped manager.unsafeGet(id);
			// else
			// data=untyped manager.unsafeGet(1);



			//get formule
			var vo_class= Type.resolveClass(_vo);
			var fullnameClass=Type.getClassName(vo_class);
			var formule:Map<String,Elements>= untyped vo_class.formule;
			var liste:MicroListe= cast {};
			liste.spodinfos= cast {};
			liste.spodinfos.id=data.id;
			liste.spodinfos.behaviour=Simple; // rootSpod
			liste.spodinfos.vo=_vo;
			liste.value= new List();
			//parse formule
			for ( key in formule.keys()){

				var m:MicroField= cast {};
				var form=formule.get(key);
				m.vo=fullnameClass;
				m.id= data.id;  //? 
	
				m.behaviour=form.behaviour;
				m.value=behaviour(m.behaviour,Reflect.getProperty(data,key));
				m.composant=form.composant;
				m.field=key;
				m.litteral=form.litteral;
				liste.value.add(m);
			}
			trace( "liste="+liste);
		return liste;
		}catch(msg:Dynamic){
			trace( "not formul pour "+_vo+ ":"+msg);
		}
		return null;
		
	}
	//little server strategy ---> move to Strategy? 
		function behaviour(beh:Behaviour, data:Dynamic){
			trace( "beh="+beh+"data="+data);
			var creator:microbe.IMicroCreator=null;
			 switch (beh){
				case Simple:
					 creator= new microbe.SimpleCreator();
					//SpodTools.traiteListe(data);
				case Microbe:
					creator= new microbe.MicrobeCreator();
				case Many:
					 //strategy= new microbe.strategies.ManyBehaviour();
					 creator= new microbe.ManyCreator();
					// SpodTools.traiteListe(data);
				case Many2Many:	
					//strategy= new microbe.strategies.ManyManyBehaviour();
				null;
			}

			 return creator.create(data);
			 //return null;
		}
}

class MicrobeCreator implements IMicroCreator{

public function new()
{
	
}
	public function create(data:Dynamic):Dynamic
	{

		trace( "create microbe"+data);
		return data;
	}
}


class ManyCreator implements IMicroCreator{

public function new()
{
	
}
	public function create(data:List<Spodable>):Dynamic
	{

		trace( "create MAny");

		return Lambda.map(data,function(s:Spodable){
			var simple=new SimpleCreator();
			simple._vo=Type.getClassName( Type.getClass(s) );
			return simple.create(s);
		});
		
	}
}