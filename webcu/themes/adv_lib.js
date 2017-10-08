// Left Right Running
function FloatTopDivLeft()
{
	var startX = (document.body.clientWidth - 780)/2 + 790;
	startY = 71;
	
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
		
	if (document.body.clientWidth < 1000) startX = -115;
	
	function mlLeft(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		el.y = startY;
		return el;
	}
	
	window.stayTopLeft=function()
	{
		if (document.body.clientWidth < 1000)
		{
			ftlObj.x = - 115;
			ftlObj.y = 0;	
			ftlObj.sP(ftlObj.x, ftlObj.y);
		}
		else
		{
			if (document.documentElement && document.documentElement.scrollTop)
				var pY = ns ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY = ns ? pageYOffset : document.body.scrollTop;
			if (document.body.clientWidth >= 1000)
			{
				ftlObj.x = (document.body.clientWidth - 780)/2 + 790;
				ftlObj.y += (pY + startY - ftlObj.y)/8;
				ftlObj.sP(ftlObj.x, ftlObj.y);
			}
			else
			{
				ftlObj.x  = startX;
				ftlObj.y += (pY + startY - ftlObj.y)/8;
				ftlObj.sP(ftlObj.x, ftlObj.y);
			}
		}
		//alert(ftlObj.x+' '+ftlObj.y);
		setTimeout("stayTopLeft()", 1);
	}
	
	//ftlObj = mlLeft("divAdRight");
	ftlObj = mlLeft("divAdRight");
	stayTopLeft();		
}
function FloatTopDivRight()
{
	var startX2 = (document.body.clientWidth - 780)/2 -110
	startY2 = 71;
	var ns2 = (navigator.appName.indexOf("Netscape") != -1);
	var d2 = document;
		
	if (document.body.clientWidth < 1000) startX2 = -115;
	
	function mlRight(id)
	{
		var el2=d2.getElementById?d2.getElementById(id):d2.all?d2.all[id]:d2.layers[id];
		if(d2.layers)el2.style=el2;
		el2.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el2.x = startX2;
		el2.y = startY2;
		return el2;
	}
	
	window.stayTopRight=function()
	{
		if (document.body.clientWidth < 1000)
		{
			ftlObj2.x = - 115;
			ftlObj2.y = 0;	
			ftlObj2.sP(ftlObj2.x, ftlObj2.y);
		}
		else
		{
			if (document.documentElement && document.documentElement.scrollTop)
				var pY2 = ns2 ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY2 = ns2 ? pageYOffset : document.body.scrollTop;

			if (document.body.clientWidth >= 1000)
			{
				ftlObj2.x = (document.body.clientWidth - 780)/2 -110
				ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/8;	
				ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			else
			{				
				ftlObj2.x  = startX2;
				ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/8;
				ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
		}
		setTimeout("stayTopRight()", 1);
	}
	
	ftlObj2 = mlRight("divAdLeft");
	stayTopRight();		
}
function ShowAdDiv()
{
	var objAdDivLeft  = document.getElementById("divAdLeft");
	var objAdDivRight = document.getElementById("divAdRight");
	
	if (document.body.clientWidth < 1000)
	{
		objAdDivRight.style.right = - 115;
		objAdDivLeft.style.left  = - 115;
	}
	
	else
	{
		objAdDivLeft.style.left = (document.body.clientWidth - 780)/2 -110
		objAdDivRight.style.left = (document.body.clientWidth - 780)/2 + 790;
	}
	FloatTopDivLeft();
	FloatTopDivRight();
}
// end x.js