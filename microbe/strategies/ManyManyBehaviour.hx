package microbe.strategies;
import microbe.client.form.*;
import api.Types;
import microbe.strategies.BehaviourFactory;
import microbe.strategies.IStrategy;
import microbe.client.Medoc;
import microbe.client.layout.ILayout;
class ManyManyBehaviour implements IStrategy{
	public var kind:String;
	public var visiteur:IMedoc;
	public var data:MicroField;
	public var layout:ILayout;
	public function new()
	{
		
	}
	//interface
	public function create(?_data:MicroListe,?microData:MicroField):Dynamic
	{
		throw "not yet";
		return null;

	}


}