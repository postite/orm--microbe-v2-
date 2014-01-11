import haxe.Template;
import sys.io.File;
import sys.FileSystem;

class Main
{
	var incr="";
	static var pack:String;
	static var def="./com/postite";
	static var neoPath:String;

	var dirs:List<String>;
	function new()
{
	neoPath=def+"/"+pack;	
	if( ! FileSystem.exists(def+"/"+pack))
	FileSystem.createDirectory(def+"/"+pack);
	dirs= new List();
	readRec(def);
	moveTo("./build.hxml","../build.hxml");
	Sys.println("delete templates ?:");
    Sys.print(">>> Y || N ");
    var reponse=Sys.stdin().readLine();
    if( reponse =="Y" || reponse=="y")
	moveOthers();
		
	}
	function moveOthers()
	{

		var dir=sys.FileSystem.readDirectory(def);
		for (i in dir) {
			if( i != pack && i!=".DS_Store"){
				trace( i);
				unlink(def+"/"+i);
			}
		}
	}
	public static function unlink( path : String ) : Void 
{ 
  if( FileSystem.exists( path ) ) 
  { 
  	trace("path="+path);
    if( FileSystem.isDirectory( path ) ) 
    { 
      for( entry in FileSystem.readDirectory( path ) ) 
      { 
        unlink( path + "/" + entry ); 
      } 
      FileSystem.deleteDirectory( path ); 
    } 
    else 
    { 
      FileSystem.deleteFile( path ); 
    } 
  } 
} 
	static public function main()
	{
		//var pop:String="pop";
		//Sys.stdout().writeString("opopo");
		//var input = Sys.stdin().readLine();

		// while(true) {
         Sys.println("Please enter the first number:");
         Sys.print(">>> ");
         var pop=Sys.stdin().readLine();
         Sys.println('le resultat est $pop');
         pack=pop;
        
     //	}
     	//
		trace(pack);

		var app = new Main();
		
	}


	function readRec(path:String)
	{
		
		
		var dir=sys.FileSystem.readDirectory(path);
		var trimedPath=StringTools.replace(path,def,neoPath);
		//trace("dir="+dir);
			for ( f in dir){
				if(f!=pack && f!=".DS_Store"){
				trace( incr+f);
				if (!FileSystem.isDirectory(path+"/"+f)){
				//trace("isDir"+ path+"/"+f);
				
				//trace("frag="+frag +" file= "+f+"upPath="+upPath);
				moveTo(path+"/"+f,trimedPath+"/"+f);
				}else{
				incr+="|____";

				trace("path="+path+"/"+f);
				FileSystem.createDirectory(trimedPath+"/"+f);

				readRec(path+"/"+f);
				
				}
				
				

			}

			}
			
		incr="";
	}

	function moveTo(_in,_out)
	{
		
		//if(!FileSystem.exists(_in+"/"+_out)) FileSystem.createDirectory(_in+"/"+_out);
		//FileSystem.rename(_in+"/"+_out,_in+"/PATATE");
		trace( "_in="+_in);
		trace( "_out="+_out);
		var er:Template=new Template(File.getContent(_in));
		var template:String=er.execute({currentApp:pack});
		File.saveContent(_out,template);
		//File.copy(_in,_out);

	}
}