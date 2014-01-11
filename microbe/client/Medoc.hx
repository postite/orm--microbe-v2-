package microbe.client;
import microbe.client.form.Microbe;
import api.Types;
// visiteur
class Medoc implements IMedoc{

var microbes:List<Microbe>;
var updated:List<MicroField>;
public function new()
{
	microbes= new List();
}

public function accepted(m:Microbe)
{
	
	microbes.add(m);
}
public function visiter():List<MicroField>
{
	updated= new List();
	//TODO: if has changed 
	for ( microbe in microbes){
		var newData=microbe.getData();
		if( microbe.microfield.value!=newData){
		trace( microbe.microfield);
		microbe.microfield.value=newData;
		updated.add(microbe.microfield);
		}
	}
	trace(" updated="+updated);
	return updated;
}
}

interface IMedoc{

	public function accepted(m:Microbe):Void;
	public function visiter():List<MicroField>;
}