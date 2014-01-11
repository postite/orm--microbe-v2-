package server.controllers;
import server.baz.Controller;
import vo.*;
class Test extends Controller
{
	public function new()
	{
		super();
	}
	function doDefault()
	{
		trace( "default");
	}
	function doBoum(t:String)
	{
		trace( "boum"+t);
	}

	function doEleveursForPets(pet:String)
	{
		var pets=Pet.manager.search($type==pet);
		var eleveurs= Lambda.map(pets,function(p:Pet)return Eleveur.manager.get(p.eleveurID));
		var farm= new Main.FarmView();
		farm.eleveurs=eleveurs;

		Sys.print (farm.execute());


	}
}