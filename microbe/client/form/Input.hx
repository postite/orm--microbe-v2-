package microbe.client.form;
import api.Types;
import js.html.InputElement;


class Input extends Microbe
{
	var me:js.html.InputElement;

	@:isVar public var value(get, set):String;
	
	function get_value():String { return value; }
	function set_value(val:String):String
	{
		//trace( "setValue"+val);
		me.value=val;
		return val;
	}
	
	public function new(micro:MicroField)
	{
		super(micro);
		var uniqId=Std.string(Std.random(20000));
		var label=js.Browser.document.createLabelElement();
		elements.add(label);
		me=cast js.Browser.document.createElement("INPUT");
		me.id=uniqId;
		elements.add(me);
		label.setAttribute("for",uniqId);
		//untyped label.htmlFor="popopopo"; //undocumented but works
		label.textContent=microfield.litteral;
		me.className="olo";
		
		me.addEventListener("blur",onBlur);
	}

	function onBlur(e)
	{
		
		value=me.value;
		trace( "blur"+me.value);
	}


	override function setData(d:String)
	{
		
		value=d;
	}
	override function getData()
	{

		return me.value;
	}
}