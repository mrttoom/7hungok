// JavaScript Document


var isIE	= (navigator.userAgent.toLowerCase().indexOf("msie") == -1 ? false : true);
var isIE6	= (navigator.userAgent.toLowerCase().indexOf("msie 6") == -1 ? false : true);
var isIE7	= (navigator.userAgent.toLowerCase().indexOf("msie 7") == -1 ? false : true);
var isChrome= (navigator.userAgent.toLowerCase().indexOf("chrome") == -1 ? false : true);

function tooltipPicture(){
	if(isIE6 || isIE7) return;
	$(".tooltip_picture[tooltipContent!=''], .tooltip_picture[tooltipPicture!='hide']").tooltip({
		bodyHandler: function(){
			width			= 350;
			height		= 350;
			if(typeof($(this).attr("tooltipWidth")) != "undefined"){
				width		= parseInt($(this).attr("tooltipWidth"));
			}
			if(typeof($(this).attr("tooltipHeight")) != "undefined"){
				height	= parseInt($(this).attr("tooltipHeight"));
			}
			$("#tooltip").css("width", width + "px");
			strReturn	= "";
			if(typeof($(this).attr("tooltipContent")) != "undefined"){
				arrTemp	= $(this).attr("tooltipContent").split("@#@");
				name		= htmlspecialbo(arrTemp[0]);
				price		= (parseFloat(arrTemp[1]) > 0 ? parseFloat(arrTemp[1]) : 0);
				if(name != "")strReturn	+= '<div class="name">' + name + '</div>';
				if(price > 0) strReturn	+= '<div class="price_product">Giá: <b class="price">' + addCommas(price) + ' VNĐ</b></div>';
			}
			tooltipPicture	= (typeof($(this).attr("tooltipPicture")) != "undefined" ? $(this).attr("tooltipPicture") : "");
			if(tooltipPicture != "hide"){
				picturePath	= "";
				if(typeof($(this).attr("picturePath")) != "undefined"){
					picturePath	= $(this).attr("picturePath");
				}else{
					picturePath	= $(this).attr("href");
				}
				
				strReturn	+= '<div class="picture">' + resizeImageSrc(picturePath, $(this).find("img").width(), $(this).find("img").height(), width, height) + '</div>';
			}
			return strReturn;
		},
		track: true,
		showURL: false,
		extraClass: "tooltip_picture"
	});
}

function tooltipProduct(ob){
	if(isIE6 || isIE7) return;
	
	if(typeof(ob) != "undefined") strTooltipProductOb = ob;
	if(typeof(strTooltipProductOb) == "undefined") return;
	arrTooltipProductOb	= strTooltipProductOb.split(",");
	arrTooltipProductOb	= $.unique(arrTooltipProductOb);
	obj	= "";
	$.each(arrTooltipProductOb, function(index, value){
		if(obj != "") obj += ",";
		obj += $.trim(value);
	});
	$(obj).each(function(index, domEle){
		var obTT	= $(domEle).parent().find(".tooltip");
		var img	= $(domEle).parent().find(".tooltip img");
		obTT.tooltip({
			bodyHandler: function(){
				tooltipWidth	= (typeof(obTT.attr("tooltipWidth")) != "undefined" ? obTT.attr("tooltipWidth") : 350);
				$("#tooltip").css("width", tooltipWidth + "px");
				$(domEle).find(".picture, .picture_only").html(function(index, html){
					width			= (typeof($(this).attr("width"))	!= "undefined" ? $(this).attr("width") : img.width());
					height		= (typeof($(this).attr("height"))!= "undefined" ? $(this).attr("height") : img.height());
					maxWidth		= (typeof($(this).attr("maxWidth"))	!= "undefined" ? $(this).attr("maxWidth") : 350);
					maxHeight	= (typeof($(this).attr("maxHeight"))!= "undefined" ? $(this).attr("maxHeight") : 350);
					arrFixSize	= fixImageSize(width, height, maxWidth, maxHeight);
					return '<img width="' + arrFixSize[0] + '" height="' + arrFixSize[1] + '" src="' + $(this).attr("src") + '" />';
				});
				return $(domEle).html();
			},
			track: true,
			showURL: false,
			extraClass: "tooltip_product"
		});
	});
}

// JavaScript Document


/*** Tooltip ***/
function tooltipReview(){
	if(isIE6 || isIE7) return;
	$(".list_review pre").each(function(index, domEle){
		obTT	= $(domEle).parent().find(".tooltip");
		obTT.tooltip({
			bodyHandler: function(){
				$("#tooltip").css("width", "300px");
				$(domEle).find(".picture, .picture_only").html(function(index, html){
					return '<img src="' + $(this).attr("src") + '" />';
				});
				return $(domEle).html();
			},
			track: true,
			showURL: false,
			extraClass: "tooltip_review"
		});
	});
}
/*-- End Tooltip --*/

function initLoaded(){
	
	
	tooltipProduct();
	
}

