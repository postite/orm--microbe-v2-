package com.postite.microbe;
class App
{

	/**
	Instanciates the main ApplicationView and the ApplicationContext.
	This will trigger the ApplicationViewMediator and kick the application off.
	*/
	public static function main()
	{
		var view = new com.postite.microbe.app.AppView();
		var context = new com.postite.microbe.app.AppContext(view);
	}
}
