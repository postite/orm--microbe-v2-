package client;
import js.Lib;
import api.Types;
import promhx.Promise;
import haxe.Http;


class Service{


	#if phpserver  static var server="http://192.168.1.34:8888"; 
	//#if phpserver  static var server="http://localhost:8888"; 
	#else
	static var server:String="http://localhost:2000";
	#end
		public function new()
		{
			trace(" hello service");
		}

	public function recMicroListe(recz:List<MicroField>):Promise<String>
	{
		return postRequest("api/rec",haxe.Serializer.run(recz));
	}

	///////// TOOLS ////////
	function basicRequest(order:String,?success:String->Promise<String>->Void,?error:String->Void):Promise<String>
	{
		var p= new Promise<String>();
		var req= new haxe.Http(server+"/"+order);
			(success==null)?req.onData=function(s)basicSuccess(s,p) :req.onData=function(s)success(s,p);
			req.onStatus=basicStatus;
			(error==null)?req.onError=basicError : req.onError=error;
			req.request(false);
		return p;
	}

	function postRequest(order:String,postdata:String,?success:String->Promise<String>->Void,?error:String->Void):Promise<String>
	{
		var p= new Promise<String>();
		var req:Http= new Http(server+"/"+order);
			(success==null)?req.onData=function(s)basicSuccess(s,p) :req.onData=function(s)success(s,p);
			req.onStatus=basicStatus;
			(error==null)?req.onError=basicError : req.onError=error;
			req.setPostData(postdata);
			req.request(true);
		return p;
	}

	function basicError(err:String):Void
	{
		trace("basic error"+err);
	}
	function basicSuccess(ret:String,p:Promise<String>):Void
	{
		trace("basic success"+ret);
		p.resolve(ret);
	}
	function basicStatus(status:Int):Void
	{
		trace("basic status"+status);
	}

}