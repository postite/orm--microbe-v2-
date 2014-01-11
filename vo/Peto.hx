package vo;

import sys.db.Types;
import ufront.db.Object;
import sys.db.Manager;
import api.Types;
import microbe.server.ivo.Spodable;

@:table("pet")
class Peto  extends ufront.db.Object 
{
	
	 public var eleveur:Null<BelongsTo<Eleveur>>;
	public var type:SString<255>; 
	public var color:SString<255>;
	public var poz:SInt;
	@:skip public static var formule:Map<String,Elements>=
	[
	"type"=>{litteral:"type",composant:"microbe.client.form.Input",behaviour:Microbe},
	"color"=>{litteral:"couleur",composant:"microbe.client.form.Input",behaviour:Microbe}
	];

	


	public function getDefaultField():String
	{
		return type;
	}
}