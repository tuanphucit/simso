with(milonic = new menuname("Main Menu"))
{
	alwaysvisible = 1;
	orientation = "horizontal";
	style = mainMenuStyle;
	aI("text=Home;url=/vietnamoriginal.com/;");
	aI("showmenu=Samples;text=Menu Samples;");
	aI("showmenu=Milonic;text=Milonic;");
	aI("showmenu=Partners;text=Partners;");
	aI("showmenu=Links;text=Links;");
	aI("showmenu=My Milonic;text=My Milonic;");
}

with(milonic = new menuname("Samples"))
{
	style = subMenuStyle;
	aI("text=Plain Text Horizontal Style DHTML Menu Bar;url=;");
	aI("text=Vertical Plain Text Menu;url=;");
	aI("text=Using The Popup Menu Function Positioned by Images;url=;");
	aI("text=Classic XP Style Menu;url=;");
	aI("text=XP Style;url=;");
}

with(milonic = new menuname("Milonic"))
{
	style = subMenuStyle;
	aI("text=Product Purchasing Page;url=;");
	aI("text=Contact Us;url=;");
	aI("text=Newsletter Subscription;url=;");
	aI("text=FAQ;url=;");
	aI("text=Discussion Forum;url=;");
	aI("text=Software License Agreement;url=;");
	aI("text=Privacy Policy;url=;");
}

with(milonic = new menuname("Partners"))
{
	style = subMenuStyle;
	aI("text=(aq) Web Hosting;url=;");
	aI("text=SMS 2 Email;url=;");
	aI("text=WebSmith;url=;");
}

with(milonic = new menuname("Links"))
{
	style = subMenuStyle;
	aI("text=Apache Web Server;url=;");
	aI("text=MySQL Database Server;url=;");
	aI("text=PHP - Development;url=;");
	aI("text=phpBB Web Forum System;url=;");
	aI("showmenu=AntiSpam;text=Anti Spam Tools;");
}

with(milonic = new menuname("AntiSpam"))
{
	style = subMenuStyle;
	aI("text=Spam Cop;url=;");
	aI("text=Mime Defang;url=;");
	aI("text=Spam Assassin;url=;");
}

with(milonic = new menuname("My Milonic"))
{
	style = subMenuStyle;
	aI("text=Login;url=;");
	aI("text=Licenses;url=;");
	aI("text=Invoices;url=;");
	aI("text=Make Support Request;url=;");
	aI("text=View Support Requests;url=;");
	aI("text=Your Details;url=;");
}

drawMenus();

