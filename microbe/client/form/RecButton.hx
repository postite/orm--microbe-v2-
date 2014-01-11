package microbe.client.form;

import js.html.ButtonElement;
import msignal.Signal;

class RecButton
{
	public var CLICKED:Signal0;
	var me:ButtonElement;
	public function new()
	{
		trace( "new");
		var input:ButtonElement=cast  js.Browser.document.body.appendChild(  js.Browser.document.createElement("BUTTON"));
		input.className="button";
		CLICKED=new Signal0();
		me=input;
		me.textContent="rec";
		me.addEventListener("click",onClick);
	}

	function onClick(e)
	{
		CLICKED.dispatch();
		trace( "clicked");
	}
}