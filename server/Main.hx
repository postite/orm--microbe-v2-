package server;
import haxe.web.Dispatch;
import vo.Eleveur;
import vo.Perso;
import vo.Pet;
import haxe.ds.StringMap;
#if neko
import neko.Web;
#else
import php.Web;
#end
using Lambda;


class Main
{

	static var params={ user : "root", port :8889, pass : "root", host : "localhost", database :"microbe" }
	static var pets = ["dog","vache","cat","mouche","cachalot","libellule"];
	function new()
	{
		//trace(new Routes().something1());
		connect();
		var uri = Web.getURI();
		try {
				Dispatch.run( uri, new StringMap(), new Routes() );
			} 
			catch (e:DispatchError) {
				//Sys.print("ERROR: " + e);
				//doDefault();
				Dispatch.run( uri, new StringMap(), this);
			}


	}

	
	public function doDefault()
	{
		Sys.print ("yo");
		
		
	}
	public function doInstall()
	{
		//sys.db.TableCreate.create(vo.Perso.manager);
		//sys.db.TableCreate.create(vo.Eleveur.manager);
		sys.db.TableCreate.create(vo.Pet.manager);
	}
	public function doAdd(titre:String,pet:String)
	{
		var p= new Perso();
		
		
		p.titre=titre;
		var dog=new Pet();
		dog.type=pet;
		dog.save();
		
		p.pet=dog;
		
		
		try{
		p.validate();
		p.save();
		doAll();
		}catch(msg:Dynamic){
		Sys.print(p.validationErrors.get("titre"));
		}

		
			//
		
	}

	public function doAddE(titre:String)
	{
		var p= new Eleveur();
		
		
		p.titre=titre;

		
		
		try{
		p.validate();
		p.save();
		p=Eleveur.manager.search({titre:p.titre}).first();
		for ( a in 0...Std.random(pets.length)){
		var pet=new Pet();
		pet.type=pets[a];
		pet.eleveur=p;
		pet.save();
		}
		doAll();
		}catch(msg:Dynamic){
		Sys.print(msg);
		}
	}
	public function doRemove(_titre:String)
	{
		
		try{
			var p=Perso.manager.search({titre:_titre}).first();
			p.delete();
			doAll();
		}catch(msg:Dynamic){
			Sys.print(msg);
		}
		
	}
	public function doAll()
	{
		trace ("all");
		var p=Eleveur.manager.all();

		for ( a in p)
			for( pet in a.pets)
			Sys.print(a.titre+"->"+pet.type);
	}
	

	function doPetsForEleveurs(_titre:String)
	{
		var eleveur=Eleveur.manager.select({titre:_titre});
		Sys.print (eleveur.pets.map(function(p:Pet)return p.type) );
		// var pets=Pet.manager.search($type==pet);
		// var eleveurs= Lambda.map(pets,function(p:Pet)return Eleveur.manager.get(p.eleveurID));
		// 	Sys.print (eleveurs);
	}
		function doDb( d : haxe.web.Dispatch ) {
                // if( !user.isAdmin ) {
                //         neko.Web.redirect("/");
                //         return;
                // }
                #if neko
                sys.db.Admin.handler();
                #end
        }

	function connect()
	{
		try{

		var cnx= sys.db.Mysql.connect(params);
		//var cnx = sys.db.Sqlite.open("bazlite.db");
		sys.db.Manager.cnx = cnx;
		sys.db.Manager.initialize();
		//var uri = Web.getURI();
		//new haxe.web.Dispatch(uri, Web.getParams()).dispatch(this);
		
		
		#if neko
		//sys.db.Admin.initializeDatabase(true, true);
		#end
		
		}catch(e:Dynamic){
			//trace( "oloé");
			
			//Web.setReturnCode(522);
			throw "pas cool" +e;
			

		}
	}
	static public function main()
	{
		//Routes.auto() ;
		var app = new Main();
	}
}


@:template("<div>
	<link rel='stylesheet' href='/style.css' />
	@for( eleveur in eleveurs){
		<p class='elev'>@eleveur.titre</p>
		@for(pet in eleveur.pets){
			<span class='pet'>@pet.type</span>
		}
	}


	</div>")
class FarmView extends erazor.macro.Template{
	public var eleveurs:List<Eleveur>;
	public var animaux:String; 
}

@:includeTemplate("../views/farm.html")
class RanchView extends erazor.macro.Template{
	public var pop:String;
}


