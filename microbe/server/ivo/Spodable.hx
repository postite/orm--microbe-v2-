package microbe.server.ivo;
import api.Types;
import sys.db.Types;
/*	import php.db.Manager;
	import php.db.Object;*/

	/**
	 * ...
	 * @author postite
	 */
/*	typedef FieldType =
	{
	var classe:String;
	var type:InstanceType;
	var champs:Dynamic;
	}
	
	enum InstanceType
	{
		formElement;
		collection;
		spodable;
	}*/
	
	//typedef Formule = Map<String,FieldType>;
	
	interface Spodable
	{
		//mov it to parent ?
		public var poz:Null<SInt>;
		public function getDefaultField():String;
	//	public static var manager:Manager<Spodable>;
	/*	public function getFields():List<Dynamic>;
			public function getHash():Hash<Dynamic>;*/
		//public var voType:String;
		public var id:Int;
	}