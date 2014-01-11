package com.postite.microbe.app;

import mmvc.api.IViewContainer;

import com.postite.microbe.view.*;
import com.postite.microbe.model.*;
import com.postite.microbe.signal.*;
import com.postite.microbe.command.*;

class AppContext extends mmvc.impl.Context
{
	public function new(contextView:IViewContainer=null)
	{
		super(contextView);
	}
	/**
	Overrides startup to configure all context commands, models and mediators
	@see mmvc.impl.Context
	*/
	override public function startup()
	{
		// wiring for todo model
		commandMap.mapSignalClass(BasicSignal,BasicCommand);
//
		injector.mapSingleton(Model);
//
		//mediatorMap.mapView(TodoListView, TodoListViewMediator);
//
		//// wiring for main application module

		mediatorMap.mapView(BasicView,BasicMediator);
		mediatorMap.mapView(AppView, AppViewMediator); 

	}

	/**
	Overrides shutdown to remove/cleanup mappings
	@see mmvc.impl.Context
	*/
	override public function shutdown()
	{

	}
}