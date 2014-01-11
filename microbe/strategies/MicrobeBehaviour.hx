package microbe.strategies;
import microbe.client.form.*;
import api.Types;
import microbe.strategies.IStrategy;
import microbe.client.Medoc;
import microbe.client.layout.ILayout;
class MicrobeBehaviour implements IStrategy{
	public var visiteur:IMedoc;
	public var data:MicroField;
	public var kind:String;
	public var layout:ILayout;
	public var wrapper:ILayout;
	public function new()
	{
		
	}
	//interface
	public function create(?_data:MicroListe,?microData:MicroField):Dynamic
	{
		data= microData;
		
		

			var composant= data.composant;
			var behaviour= data.behaviour;
			

			if (data.composant!=null){
				var Ccomp=Type.resolveClass(composant);
				var comp:Microbe=Type.createInstance(Ccomp,[data]);
				layout.add(comp);
				//trace(comp.microfield);
				comp.accepter(visiteur);
				comp.setData(data.value);
			}
		
		
		return null;
	}
	
}