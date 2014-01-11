
package com.postite.microbe.signal;

import msignal.Signal.Signal1;

class BasicSignal extends Signal1<String>{


	public var complete:Signal1<String>;
	
	public function new(){
		complete= new Signal1();
		super(String);
	}

}