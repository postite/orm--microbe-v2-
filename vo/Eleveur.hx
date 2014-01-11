package vo;
import haxe.ds.StringMap;
import sys.db.Types;
import ufront.db.Object;
import sys.db.Manager;
import api.Types;
import microbe.server.ivo.Spodable;

@:table("eleveur")
class Eleveur extends ufront.db.Object implements Spodable
{

	// @:validate( _.length>6, "titre must be at least 6 characters long" )
	public var titre:Null<SString<255>>;
	public var pets:HasMany< Pet >  ;
	public var poz:Null<SInt>;
	//public var perso:Null<HasOne<Perso>>;
	@:skip public static var formule:Map<String,Elements>=
	[
	"titre"=>{litteral:"un",composant:"microbe.client.form.Input",behaviour:Microbe},
	"pets"=>{litteral:"animaux",composant:"vo.Pet",behaviour:Many}
	];
public function new()
	{
		super();
	}

	public function getDefaultField():String
	{
		return titre;
	}
	public static var manager:Manager<Eleveur>= new Manager(Eleveur);
}