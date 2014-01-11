package microbe.server;
import sys.db.Manager;
import sys.db.RecordInfos;
import haxe.ds.StringMap;
import sys.db.Object;

class SpodTools
{
	function new()
{
		
	}


	public static function getManagerfromString(_vo:String):Manager<Object>
	{
		 
                var stringVo = "vo."+_vo; 
                
                var t:sys.db.Manager<Object>= Reflect.field(Type.resolveClass(stringVo),"manager");
                
                return t;
                      
	}

	public static function createInstance(_vo:String):Object
	{
		trace(_vo);
		
		var _class=Type.resolveClass("vo."+_vo);
		return cast Type.createInstance(_class,[]);
	}

	public static function traiteFormule(arguments)
	{
		
	}

	/////// tools

	public static function traiteListe(liste:List<sys.db.Object>):List<Dynamic>{
		var cached=new List();
		Lambda.map(liste,function(s){
			//trace( "session="+s);
//trace ( "user= "+Reflect.callMethod(first,"pop",[]) +" ");
			cached.add (normalizeSpod(s));
			});
		return cached;
	}


public static function hasFunction(ob : Dynamic, methodName : String) : Bool
{
var field : Dynamic = Reflect.field(ob, methodName);
if(field == null) return false;

return Reflect.isFunction(field);
}

	public static function normalizeSpod(s:Object){
		//trace( "normalizeSpod");
		if (s==null)return {};
		//trace( Reflect.field(first, "get_"+"user"));
		var cache=cast {};
			//cached.add(Reflect.field(s,"__cache__"));
			//trace( 'one');
			var manager=getManager(s);
			//trace(" two");
			//trace( manager.dbInfos().hfields);
			

			if( manager.dbInfos() !=null && !(hasFunction(s,"toObj"))){ 
			//	trace( "three");
			var fields:StringMap<RecordField>= manager.dbInfos().hfields;
			
			var relation:Array<sys.db.RecordRelation> = manager.dbInfos().relations;
			
			if (relation!=null){
				//trace( "relation="+relation);
			for (a in relation){
				trace("prop="+a.prop+"key="+a.key);
				var rel:sys.db.Object= cast Reflect.callMethod(s,Reflect.field(s, "get_"+a.prop)   ,[]) ;
				//trace( "rel="+rel);
				if( rel!=null){
				var normRel=normalizeSpod(rel);
				Reflect.setField(cache,a.prop,normRel);
				}
				//Sys.print ( );
			}
			
			}
			for (a in fields.keys()){
			var field=Reflect.field(s,a);
			if( Std.is(field,haxe.io.Bytes)) {
				
				trace( "-----BYTES POAWA------- "+a);
				var binaryList = cast Reflect.callMethod(s,Reflect.field(s, "get_"+a),[]);
					//if it'a list
					trace( Type.typeof(binaryList));
					if( Std.is(binaryList,List)){
						//trace( "it's a list");
							var malist:List<Dynamic>= cast binaryList;
							var t:List<Dynamic>= new List();

							for (b in malist){
								//trace( malist.length);
								trace("----------------"+cast (b).nom);

								var norm=normalizeSpod(cast b); 
								t.add( norm);

							}
							field= t;
					
					}else{
						field=binaryList;
					}
					//trace (" after bytes powa");

				//throw "error" +field;
				}
			Reflect.setField(cache,a,field);
			}
			
			}else{
				//trace ("NO HFIELDS");
				cache= cast(s).toObj(); //hack for php
				//trace( "cache="+cache);
			}//if dbInfos!=nulll
			
			return cache;
			//trace( "cache="+cache);
			
	}


	static function  getManager(s:sys.db.Object)
	{
		var c=Type.getClass(s);
		return cast Reflect.field(c,"manager");

	}
}