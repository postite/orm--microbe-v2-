package client;
import js.Lib;
import api.Types;
// import microbe.client.form.Input;
 import microbe.client.form.Microbe;
import microbe.client.Medoc;
import microbe.client.form.RecButton;
import microbe.client.form.Input;
import microbe.strategies.BehaviourFactory;
import microbe.client.layout.*;
class Client
{
	public var visiteur:Medoc;
	function new()
	{
		trace( "hello");
		js.Browser.window.addEventListener("load",init);
		
	}

	public function init(e)
	{
		trace( "init");
	
		var domData:MicroListe = getDataFromDom();

	 	visiteur= new Medoc();

		var behaviour=new BehaviourFactory();
		trace ('datafromDom='+domData);
		var strategy:microbe.strategies.IStrategy=behaviour.create(domData.spodinfos.behaviour);
		trace( "domData"+domData.spodinfos.behaviour);
		trace( "set viz");
		strategy.layout= new SimpleLayout();
		strategy.visiteur=visiteur;
		
		trace( "kind="+strategy.kind);
		strategy.create(domData);
		trace (strategy.layout);
		var button=new RecButton();
		button.CLICKED.add(visite);
	}
	function getDataFromDom():MicroListe{
		var xdata= js.Browser.document.querySelector("#data").getAttribute("microbe-data");
		var data:MicroListe= cast haxe.Unserializer.run(xdata);
		//trace( "data="+data);
		return data;
	}
	function visite()
	{
		var updated=visiteur.visiter();

		new Service().recMicroListe(updated);
	}

	static public function main()
	{
		var app = new Client();
	}
}