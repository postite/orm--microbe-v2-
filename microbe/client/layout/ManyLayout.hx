package microbe.client.layout;

class ManyLayout extends BaseLayout implements ILayout
{
	
	public function new()
	{
		super();


		lay=cast stage.appendChild(js.Browser.document.createDivElement());
		lay.className="many";
		//lay.classList.add("layout");
		
		//@todo make a tool of it ! 
		

		#if debug
		BaseLayout.sheet.insertRule(".many { background:grey;padding:5px; }", BaseLayout.count++);
		#end

		stage.appendChild(lay);
		trace( "hello Many layout");	
	}

	override public function add(comp:Dynamic)
	{
		 var elements:Iterable<Dynamic>= comp.elements;
		
		 for ( el in elements )
			lay.appendChild(el);

		
		trace( "added to added");
	}
	override public function wrap(layout:ILayout)
	{
		lay.appendChild(layout.lay);
	}
}