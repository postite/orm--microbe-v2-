package microbe.client.form;

import api.Types;
import microbe.client.Medoc.IMedoc;
import js.html.Element;
@:keepSub
class Microbe {
	var visiteur:IMedoc;
	public var microfield:MicroField;
	public var elements:List<Element>;
	public function new(micro:MicroField)
	{

		this.microfield=micro;
		elements= new List();
	}

	


	public function  accepter(viz:IMedoc) 
    {
    	
    	viz.accepted(this);  
    	
    }

    public function setData(v:Dynamic){}
    public function getData():Dynamic{return null;}
    
}