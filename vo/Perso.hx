package vo;
import sys.db.Types;
import ufront.db.Object;
import sys.db.Manager;
import api.Types;
import microbe.server.ivo.*;

@:table("perso")
class Perso extends ufront.db.Object implements Spodable
{

	 @:validate( _.length>6, "titre must be at least 6 characters long" )
	public var titre:SString<255>;
	public var pet:BelongsTo< Pet >;
	public var genre:SString<255>;
	public var poz:Null<SInt>;


	@:skip public static var formule:Map<String,Elements>=
	[
	"titre"=>{litteral:"type",composant:"microbe.client.form.Input",behaviour:Microbe},
	"genre"=>{litteral:"couleur",composant:"microbe.client.form.Input",behaviour:Microbe}
	];
	public function new()
	{
		super();
	}
	public function getDefaultField():String
	{
		return titre;
	}
	public static var manager:Manager<Perso> = new Manager(Perso);
}