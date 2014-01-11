package microbe.strategies;
import microbe.client.form.*;
import api.Types;
import microbe.strategies.BehaviourFactory;
import microbe.strategies.IStrategy;
import microbe.client.Medoc;
import microbe.client.layout.*;
class ManyBehaviour implements IStrategy{
	public var kind:String;
	public var visiteur:microbe.client.Medoc.IMedoc;
	public var data:MicroField;
	public var layout:ILayout;
	public var wrapper:ILayout;
	public function new()
	{
		trace( "new Many");
	}
	//interface
	public function create(?_data:MicroListe,?microData:MicroField):Dynamic
	{

		
		data=microData;
		var list:List<Dynamic>=data.value;
		//data= _data;
		//trace( "create="+data.spodinfos.vo);
		//trace( "data= "+_data);
		//trace( "simpledata="+microData);

		var box=js.Browser.document.createDivElement();
		box.className="container";
		js.Browser.document.body.appendChild(box);
		trace ( "create many layout");
		wrapper=new ManyLayout();
		for ( micro in list){
			//trace( "value="+micro);
			var strategy= new Simple();
			strategy.wrapper=wrapper;
			strategy.layout=new SimpleLayout();
			strategy.visiteur=visiteur;
			strategy.create(micro);
			wrapper.wrap(strategy.layout);

		}
		return null;

	} 
}