package com.postite.microbe.view;
class BasicMediator extends mmvc.base.MediatorBase<BasicView>
{

	@inject public var basicSignal:com.postite.microbe.signal.BasicSignal;
	function new()
	{
		super();
		//trace("op");
	}
	/**
	Dispatches loadTodoList on registration of mediator
	@see mmvc.impl.Mediator
	@see mmvc.base.MediatorBase.mediate()
	*/
	override function onRegister()
	{
		//using mediate() to store listeners for easy cleanup during removal
		// mediate(view.signal.add(viewHandler));
		// mediate(loadTodoList.completed.addOnce(loadCompleted));
		// mediate(loadTodoList.failed.addOnce(loadFailed));

		// loadTodoList.dispatch();

		trace("yo");
		basicSignal.complete.addOnce(function(s)trace(s));
		basicSignal.dispatch("opla");
	}
}