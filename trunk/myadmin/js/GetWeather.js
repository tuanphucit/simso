function ShowWeatherBox(vId)
{
	var sLink = '';
	sLink = PageHost.concat('/ListFile/Weather/');
	switch (parseInt(vId)){
		case 1: sLink = sLink.concat('Sonla.xml');break;
		case 2: sLink = sLink.concat('Viettri.xml');break;
		case 3: sLink = sLink.concat('Haiphong.xml');break;
		case 4: sLink = sLink.concat('Hanoi.xml');break;
		case 5: sLink = sLink.concat('Vinh.xml');break;
		case 6: sLink = sLink.concat('Danang.xml');break;
		case 7: sLink = sLink.concat('Nhatrang.xml');break;
		case 8: sLink = sLink.concat('Pleicu.xml');break;	
		case 9: sLink = sLink.concat('HCM.xml');break;
		default: sLink = sLink.concat('Hanoi.xml');break;
	}
	AjaxRequest.get({
				'url':sLink, 'onSuccess':function(req){
				var vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather;
				vAdImg = req.responseXML.getElementsByTagName('AdImg').item(0).firstChild.nodeValue;
				vAdImg1 = req.responseXML.getElementsByTagName('AdImg1').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild != null)
					vAdImg2 = req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild != null)
					vAdImg3 = req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild != null)
					vAdImg4 = req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild != null)
					vAdImg5 = req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild.nodeValue;
				vWeather = req.responseXML.getElementsByTagName('Weather').item(0).firstChild.nodeValue;
				GetWeatherBox(vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather);
			},'onError':function(req){}
		})
}

function GetWeatherBox(vImg, vImg1, vImg2, vImg3, vImg4, vImg5, vWeather)
{
	var sHTML = '';
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg).concat('" class="img-weather" alt="" />&nbsp;');
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg1).concat('" class="img-weather" alt="" />');
	if(vImg2 != null)
	{
		sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg2).concat('" class="img-weather" alt="" />');
	}
	if(vImg3 != null)
	{
		sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg3).concat('" class="img-weather" alt="" />');
	}
	if(vImg4 != null)
	{
		sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg4).concat('" class="img-weather" alt="" />');
	}
	if(vImg5 != null)
	{
		sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg5).concat('" class="img-weather" alt="" />');
	}
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/c.gif" class="img-weather" alt="" />');

	gmobj('img-Do').innerHTML = sHTML;
	gmobj('txt-Weather').innerHTML = vWeather;
}

function gmobj(o)
{
	if(document.getElementById){ m=document.getElementById(o); }
	else if(document.all){ m=document.all[o]; }
	else if(document.layers){ m=document[o]; }
	return m;
}