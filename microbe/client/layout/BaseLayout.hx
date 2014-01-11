package microbe.client.layout;
import js.html.Element;
class BaseLayout implements ILayout
{
	public var stage:View;
	#if debug
	public static var sheet:js.html.CSSStyleSheet;
	public static var count:Int;
	#end
	public var lay:View;
	public function new()
	{
		
		stage= js.Browser.document.querySelector("#content");
		#if debug
		var sheets = js.Browser.document.styleSheets; // returns an Array-like StyleSheetList
		sheet=cast sheets[0];
		sheet.insertRule(".layout{padding:2px;}",BaseLayout.count++);
		#end
	}
	public function add(comp:Dynamic)
	{
		// var elements:Iterable<Dynamic>= comp.elements;
		// //stage.appendChild(js.Browser.document.createDivElement());
		// for ( el in elements )
		// stage.appendChild(el);
		// trace( "added");
	}

	public function wrap(layout:ILayout)
	{
		
	}
}