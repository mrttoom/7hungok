<?
ob_start();
session_start();
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
define("hdc","hdc",true);
include "admin/define_data.php";
include "admin/config.php";
include "admin/sql.php";
include "admin/connect.php";
include "counter.php";
$require="<font color=#E8862B>(*)</font>";
$vip = '.html';
$tde = 'Vựa Trái Cây Bảy Hùng';
$key = 'Vựa Trái Cây Bảy Hùng, Vua trai cay, vựa trái cây, Vu sua lo ren, vu sua, vú sửa lò rèn, vú sửa, vu sua lo ren vinh kim';
$mota = 'Vựa Trái Cây Bảy Hùng, Vua trai cay, vựa trái cây, Vu sua lo ren, vu sua, vú sửa lò rèn, vú sửa, vu sua lo ren vinh kim';


if(($_SESSION['rate'] == '')||(!isset($_SESSION['rate']))) $_SESSION['rate'] = '1'.' '.'VND';
$explode = explode(' ',$_SESSION['rate']);
?>


<Meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/link.css">
<link rel="stylesheet" type="text/css" href="css/style.css">



<link rel="stylesheet" type="text/css" href="tooltips/tooltiptheme.css"     />


<script type="text/javascript" src="tooltips/jquery.min.js"></script>
<script type="text/javascript" src="tooltips/functions_main.js"></script>
<script type="text/javascript" src="tooltips/jquery.tooltip.js"></script>
<link rel="shortcut icon" href="/images1/icon.ico" />



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31266766-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</head>

<body >

<table width="988" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="9"  background="images1/t.jpg">&nbsp;</td>
    <td width="970">
	<table width="970" align="center" border="0" cellspacing="0" cellpadding="0"  >
	
  <tr>
  <td   >
 <? include "banner.php";?>
	
  </td>
  </tr>
  
  
   <tr>
  <td  background="images1/bodyBG.png" height="70" >
  <table width="970" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><? include "top.php";?></td>
  </tr>
  <tr>
    <td height="40" valign="middle"> <? include "chuchay.php";?> </td>
  </tr>
</table>

 
	
  </td>
  </tr>
  
 
 
		 
  <tr>
    <td width="970"  >
        <table width="970" border="0" cellpadding="0" cellspacing="0"  bgcolor="#ffffff">
        
          <tr>
		    <td width="5" valign="top"  >&nbsp;</td>
             <td width="200" valign="top"  >
                <? include "MenuLeft.php";?> 
            </td>
            <td width="3" valign="top"  >&nbsp;</td> 
            <td width="100%"  valign="top"   >
				 <div style="font-size: 1px; height: 2px;"></div>

				<?
                if(file_exists("./".$_GET['page'].".php"))	  {
                   include "./".$_GET['page'].".php";
				  
                }
                else {
                include "center.php";
                }
                ?> 
								 <div style="font-size: 1px; height: 50px;"></div>
          
				 </td>
		
						
		
			 <td width="180" valign="top"  >
                <? include "MenuRight.php";?> 
            </td>
			
			<td width="5" valign="top"  >&nbsp;
                 
            </td>
			  
			
          </tr>
		  </table>
		  </td>
		  </tr>

     <tr>
            <td   align="center" valign="top"  >
              <? include "bottom.php";?>
            </td>
          </tr>
  
</table>
</td>
    <td width="9"  background="images1/p.jpg">&nbsp;</td>
  </tr>
</table>

</body>
