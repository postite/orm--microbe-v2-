
package microbe.server;
import haxe.Serializer;
import microbe.server.ivo.Spodable;
class SpodSerializer extends Serializer
{
	public static var USE_ENUM_INDEX:Bool = false;
	 public function new () {
                super();
                
                useCache = true;
                useEnumIndex = USE_ENUM_INDEX;
                
       }
	public override function serialize (v:Dynamic):Void {
			// if (Std.is(v, Spodable)) {
			// 	super.serialize(SpodTools.normalizeSpod(v));
			// }else{
			super.serialize(v);
			//}
	}

	 public static function run (t:Dynamic):String {
                var s = new SpodSerializer();
                //s.buf.add("<!DOCTYPE html>");
                s.serialize(t);
                return s.toString();
        }

}