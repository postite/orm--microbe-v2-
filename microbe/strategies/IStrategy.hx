package microbe.strategies;
import api.Types;
import microbe.client.Medoc.IMedoc;
import microbe.client.layout.ILayout;
interface IStrategy{
	public var kind:String;
	public var visiteur:IMedoc;
	public var layout:ILayout;
	public var wrapper:ILayout;

	public function create(?_data:MicroListe,?microData:MicroField):Dynamic;
}