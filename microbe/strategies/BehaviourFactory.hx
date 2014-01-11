package microbe.strategies;

import api.Types.Behaviour;

import microbe.strategies.IStrategy;
import microbe.strategies.MicrobeBehaviour;
import microbe.strategies.*;
import microbe.client.Medoc;
class BehaviourFactory
{
	//public var visiteur:IMedoc;
	#if !server
	public function new()
	{
		
		
	}
	

	public function create(type:Behaviour):IStrategy{
		//trace( "behaviour="+type);
		var strategy:IStrategy=null;
		switch ( type )
		{
			case Simple:
			strategy= new Simple();
			case Microbe:
			strategy= new MicrobeBehaviour();
			case Many:
			strategy= new ManyBehaviour();
			case Many2Many:
			strategy= null;
			
		}
		
		return strategy;
	}


	#else


	// public function create(type:Behaviour):IStrategy{
	// 	switch ( type )
	// 	{
	// 		case Simple:
	// 		return new Simple();
	// 		case Behaviour.Many:
	// 		return null;
	// 		case Behaviour.Many2Many:
	// 		return null;
			
	// 	}
	// }



	#end
}