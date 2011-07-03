	function fillup(){
	
	if (iedom){
		cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2;
		cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3;
		cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
		actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth;
		cross_slide2.style.left=actualwidth+slideshowgap+"px";
	}
	else if (document.layers){
		ns_slide=document.ns_slidemenu.document.ns_slidemenu2
		ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
		ns_slide.document.write(leftrightslide)
		ns_slide.document.close()
		actualwidth=ns_slide.document.width
		ns_slide2.left=actualwidth+slideshowgap
		ns_slide2.document.write(leftrightslide)
		ns_slide2.document.close()
	}
	lefttime=setInterval("slideleft()",20)
}

function slideleft(){
	if (iedom){
		if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
			cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed2+"px"
		else
			cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"
			
		
		if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
			cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed2+"px"
		else
			cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"

	}
	else if (document.layers){
		if (ns_slide.left>(actualwidth*(-1)+8))
			ns_slide.left-=copyspeed2
		else
			ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

		if (ns_slide2.left>(actualwidth*(-1)+8))
			ns_slide2.left-=copyspeed2
		else
			ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
	}
}
