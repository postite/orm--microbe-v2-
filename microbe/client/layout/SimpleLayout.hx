package microbe.client.layout;

class SimpleLayout extends BaseLayout implements ILayout
{
	
	public function new()
	{
		super();


		lay=cast stage.appendChild(js.Browser.document.createDivElement());
		lay.className="simple";
		lay.classList.add("layout");
		

		#if debug
		BaseLayout.sheet.insertRule(".simple { background:blue;border:1px solid black;}", BaseLayout.count++);
		#end

		
		trace( "hello Many layout");	
	}

	override public function add(comp:Dynamic)
	{
		var elements:Iterable<Dynamic>= comp.elements;
		//stage.appendChild(js.Browser.document.createDivElement());
		for ( el in elements )
		lay.appendChild(el);
		stage.appendChild(lay);
		trace( "added");
	}
	override public function wrap(layout:ILayout)
	{
		
	}
}