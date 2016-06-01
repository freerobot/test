<?php
	session_start();
    
    if(empty($_SESSION['numb'])){
    	$_SESSION['numb'] = 10;
    }elseif(isset($_POST['numb'])){
        $_SESSION['numb'] = $_POST['numb'];
    }
    
    if(empty($_SESSION['limit'])){
    	$_SESSION['limit'] = 'd';
    }elseif(isset($_POST['limit'])){
        $_SESSION['limit'] = $_POST['limit'];
    }
    
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
   <style>
       *{ direction: rtl; font-family: tahoma; font-size: 12px; }
       body{ background: #e2e2e2; }
       .google{ direction: ltr; display: block; text-align: center;}
       .google span.g{ background: #898989; color: #faf9f9; padding: 10px 17px; font-family: courier; font-size: 15px; border-radius: 0 0 0 10px; text-shadow: 1px 1px 1px #363636;}
       .google span.r{ background: #b70000; color: #faf9f9; padding: 9px 17px 11px 17px; font-size: 14px; border-radius: 0 0 10px 0 ; text-shadow: 1px 1px 1px #363636;}
       .results{ background: #7d7d7d; margin: 0 auto; color: #fff; width: 750px; font-size: 13px; text-align: justify; line-height: 27px; padding: 15px; text-shadow: 1px 1px 1px #1a1a1a; border-radius: 10px; box-shadow: inset 0 0px 30px #323131;}
       .pagin{margin: -15px auto 0 auto; color: #fff; width: 750px; font-size: 13px; font-weight: bold; text-align: center;}
       .pagin a{text-decoration: none; color: #b70000; }
       .s{margin: 15px auto 0 auto; color: #fff; width: 750px; font-size: 13px; font-weight: bold; text-align: center;}
       .s input[type="text"]{ width: 300px; border: 1px solid #7d7d7d; background: #898989; color: #faf9f9; padding: 10px 17px 12px 17px; margin: 0 0 0 -4px; font-size: 14px; border-radius: 0 10px 10px 0; text-shadow: 1px 1px 1px #363636;}
       .s input[type="submit"]{border: 1px solid #7d7d7d; background: #b70000; color: #faf9f9; padding: 9px 17px 11px 17px; font-size: 14px; border-radius: 10px 0 0 10px; text-shadow: 1px 1px 1px #363636;}
       small{ font-size: 10px;}
       table{ border: 1px solid #626262; padding: 7px; background: #dadada; wifth: 400px; margin: 15px auto 0 auto;}
       table td{ padding: 0 7px;}
       table input, table select{ border: 1px solid #626262; padding: 4px;}
       table input[type="text"]{ border: 1px solid #626262; padding: 4px; width: 50px; text-align: center;}
   </style>
</head>
<body>
<div class="wrapper">
   <?php
   require 'simple_html_dom.php';

   if(isset($_GET['page'])){
      $page = $_GET['page'];
   }else{
      $page = 0;
   }

   if(isset($_GET['submit'])){
      $query = $_GET['query'];
      $query = str_replace(' ', '+', $query);
   }else{
     $query = '';
   }
   
   $start = $page*$_SESSION['numb'];
     
      
      $murl = "http://www.google.com/search?q=" .$query. "&oq=" .$query. "&ie=UTF-8&start=" .$start. "&as_qdr=" .$_SESSION['limit']. "&num=" .$_SESSION['numb'];
      echo '<div class="google"><span class="g">'.$murl.'</span><span class="r">&#1570;&#1583;&#1585;&#1587; &#1711;&#1608;&#1711;&#1604;</span></div>';

      $curl = curl_init(); 
      curl_setopt($curl, CURLOPT_URL, $murl);  
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
      $str = curl_exec($curl);  
      curl_close($curl);  
 
      $html= str_get_html($str); 
      
      $total_page = '';
?>

  <p><br></p>
  	  
  <div class="results">
<?php
      foreach($html->find('h3 a') as $element){
      	  echo iconv("ISO-8859-1", "UTF-8", $element->plaintext). ' , ';
      }
      
?>
  </div>

  <p><br></p>

  <div class="pagin">
<?php
if ($page > 0) {
   $prev = $page - 1;
   echo "<a href='?page=$prev&query=$query&submit=+&#1575;&#1585;&#1587;&#1575;&#1604;+'>&laquo;&laquo; &#1602;&#1576;&#1604;&#1740;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
if ($html->find('h3 a')) {
   $next = $page + 1;
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?page=$next&query=$query&submit=+&#1575;&#1585;&#1587;&#1575;&#1604;+'>&#1576;&#1593;&#1583;&#1740; &raquo;&raquo;</a>";
}
?>
  </div>

 <div class="s">
  <form method="get">
 	 <input type="text" name="query">
	 <input type="submit" name="submit" value=" &#1575;&#1585;&#1587;&#1575;&#1604; ">
  </form>
 </div>

 <table>
  <form method="post">
    <tr>
 	 <td><input type="text" name="numb" value="100"></td>
 	 <td><select name="limit">
 	    <option value="d">24 &#1587;&#1575;&#1593;&#1578;</option>
 	    <option value="w">&#1607;&#1601;&#1578;&#1607;</option>
 	    <option value="a">&#1607;&#1585; &#1586;&#1605;&#1575;&#1606;&#1740;</option>
 	 </select></td>
	 <td><input type="submit" name="submit" value=" &#1584;&#1582;&#1740;&#1585;&#1607; "></td>
	</tr>
	<tr>
	 <td><small>&#1606;&#1578;&#1575;&#1740;&#1580;/&#1589;&#1601;&#1581;&#1607;</small></td><td colspan="2"><small>&#1605;&#1581;&#1583;&#1608;&#1583;&#1607; &#1586;&#1605;&#1575;&#1606;&#1740;</small></td>
	</tr>
  </form>
 </table>
</div>
</body>
</html>