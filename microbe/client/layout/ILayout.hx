package microbe.client.layout;

interface ILayout
{
	public var lay:View;
	public function add(comp:Dynamic):Void;
	public function wrap(layout:ILayout):Void;
	
}