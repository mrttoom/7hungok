var xmlHttp
function Category(str)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="Category2.php";
url=url+"?subID="+str;
xmlHttp.onreadystatechange=state;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
function state() 
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById("showSubCategory").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
} 
