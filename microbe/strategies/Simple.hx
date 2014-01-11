package microbe.strategies;
import microbe.client.form.*;
import api.Types;
import microbe.strategies.BehaviourFactory;
import microbe.strategies.IStrategy;
import microbe.client.Medoc;
import microbe.client.layout.*;
class Simple implements IStrategy{
	public var kind:String;
	public var visiteur:IMedoc;
	public var data:MicroListe;
	public var layout:ILayout;
	public var wrapper:ILayout;
	public function new()
	{
		kind="simple";
	}

	//interface
	public function create(?_data:MicroListe,?microData:MicroField):Dynamic
	{

			data= _data;
			var microliste:MicroListe= cast {};
			microliste.spodinfos= cast {};
			microliste.spodinfos.vo=data.spodinfos.vo;
			microliste.spodinfos.behaviour=data.spodinfos.behaviour;
			microliste.spodinfos.id=data.spodinfos.id;
			microliste.value=data.value;
		
			
				for ( val in data.value){
				trace( "behaviour="+val.behaviour);
			//trace( "microliste="+microliste);

				var strategy= new BehaviourFactory().create(val.behaviour);
				strategy.layout=layout;
				trace( "layout="+layout);
				strategy.wrapper=wrapper;
				strategy.visiteur=visiteur;
				//trace( "val="+val);
				var output=strategy.create(val);
			//trace( "strategy="+strategy);
			}
			return null;
		//return
		
		
	
	} 
}