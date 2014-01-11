package api;





typedef MicroField={
	id:Int,
	vo:String,
	value:Dynamic,
	field:String,
	litteral:String,
	composant:String,
	behaviour:Behaviour
}
typedef MicroListe={
	spodinfos:SpodInfos,
	value:List<MicroField>
}
typedef SpodInfos={
	vo:String,
	id:Int,
	behaviour:Behaviour
}

typedef Formule=Map<String,Elements>;


typedef Elements={
	
	litteral:String,
	composant:String,
	behaviour:Behaviour
}

enum Behaviour{

	Microbe;
	Many;
	Simple;
	Many2Many;
}

class Types{

}