<!--
function setTransition()
{
	if (document.all)
	{
		myProImg.filters.revealTrans.Transition=Math.floor(Math.random()*23);
		myProImg.filters.revealTrans.apply();	
	}
}

function playTransition()
{
	if (document.all)
	{
		myProImg.filters.revealTrans.play();
	}
}

function nextAd()
{
	if(curKey < totalPro - 1) curKey ++ ;
	else curKey = 0;
	setTransition();
	//adNum = Math.floor(Math.random()*5);   //3: so chieu cua array
	
	myProName.innerHTML = listName[curKey];
	
	curOrder = curKey + 1;
	strOrder = curOrder + '/' + totalPro;
	myProOrder.innerHTML = strOrder;

	document.images.myProImg.src = listImg[curKey];
	
	playTransition();
	theTimer = setTimeout("nextAd()", 3000);
}
//-->