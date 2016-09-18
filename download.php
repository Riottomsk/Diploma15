<html>
<head>
	<title>Загруженные документы</title>
<style type ="text/css">
#header {
	position:absolute;
	top:0px;
	left:0px;
	
	width: 100%;
	height: 55px;
	background-image: url(sample.jpg);
	background-size: 100%

}
h1{
  color: #ffffff; 
  font: 35px Georgia; 
  margin-left: 10px;
  margin-top: 5px;
}
h2{
  color:#ffffff;
  font: Georgia; 
}


</style>
</head>

<body>
<header>
<div id="header">

		<h1>Загруженные документы</h1>
</div>
</header>
<br><br><br>


<div>
<form action='download.php' method=post>
	<button name='sort' value=1 style='background:url(sample-main.jpg); height:55px; width:140px'><h2 align=center'> В работе </h2></button>
	<button name='sort2' value=1 style='background:url(sample-main.jpg); height:55px; width:180px'><h2 align=center'> Завершенные </h2></button>
	<button formaction = 'Docsexplorer.php' style='background:url(sample-main.jpg); height:40px; position:absolute; top:57px; right:5px'><h2 style=" line-height:3px; font-size: 15px"> К управлению документами </h2></button>	
</form>
<br>

<form action='download.php' method=post>
<input type='text' name='search' value=''>
<input name="<?php if(isset($_POST['sort'])) { echo 'sort';} else {echo'sort2';}?>"type='submit' value='Искать'>
</form>



<?php

if (isset($_POST['search']) && $_POST['search']<>"")
{
	$search = "and (customer LIKE '%".$_POST['search']."%' or object LIKE '%".$_POST['search']."%' or adress LIKE '%".$_POST['search']."%') ";
	//$search = "and customer LIKE '%Томск%' ";
}
else
{
	$search = "";
}

if(isset($_POST['sort']))
{
$SO = 0;

if (isset($_POST['sortorder']))
{	
	$SO = $_POST['sortorder'];
}

$D ="";
if (isset($_POST['DESC']) && ($_POST['sort'] == $_POST['DESC']) && ($SO == 0))
{
	$D = "DESC";
	$SO = 1;
}
else
{
	$SO = 0;
}


echo "
<h2 style='color:#000000'> В работе</h2>
<table border='1px'  cellspacing='0' cellpadding='1'>
<tr>
<form action='download.php' method='post'>
	<td><button type=submit name='sort' value='1' style='width:100%'>#</button></td>
	<td><button type=submit name='sort' value='2' style='width:100%'>Заказчик</button></td>
	<td><button type=submit name='sort' value='3' style='width:100%'>Объект</button></td>
	<td><button type=submit name='sort' value='4' style='width:100%'>Адрес</button></td>
	<td><button type=submit name='sort' value='5' style='width:100%'>Дата загрузки документа</button></td>
	<td><button type=submit name='sort' value='6' style='width:100%'>Этап</button></td>
	<td><button type=submit name='sort' value='7' style='width:100%'>Тип</button></td>
	<td><button type=submit name='sort' value='8' style='width:100%'>Менеджер</button></td>
	<td><center>Скачать</center></td>
	<td><center>В завершенные</center></td>
<input name='DESC' hidden value=".$_POST['sort'].">
<input name='sortorder' hidden value=".$SO.">

</form>
</tr>
	";


try {

$conn = new PDO("mysql:host=localhost;dbname=test", "root", "admin");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->exec("SET NAMES cp1251"); 
  if (!$conn) 
  { 
    echo "<p>К сожалению, не доступен сервер mySQL</p>"; 
    //exit(); 
  } 
$type = array(
	   1 => "Заявка",
	   2 => "Тех. задание",
	   3 => "Спецификация",
	   4 => "Смета",
	   5 => "Коммерческое предложение",
	   6 => "Договор",
	   7 => "Наряд задание",
	   8 => "Акт выполненных работ"
	);
$location = "C:/apache/localhost/www/files/";
$start = strlen($location);

if ($_POST['sort'])
	{ $sort=$_POST['sort'];}
else
	{ $sort = 0;}


switch($sort)
{
	case 0:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by lastdate DESC ;");
		break;
	case 1:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by id ".$D.";");
		break;
	case 2:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by customer ".$D.";");
		break;
	case 3:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by object ".$D.";");
		break;
	case 4:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by adress ".$D.";");
		break;
	case 5:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by lastdate ".$D.";");
		break;
	case 6:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by direction ".$D.";");
		break;
	case 7:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by type ".$D.";");
		break;
	case 8:
		$stat = $conn->query("Select * from docs where status = 1 ".$search." order by manager ".$D.";");
		break;
}
		


while ($row = $stat->fetch())
{
	$t = $type[$row['type']];
	echo"<tr><td>".$row['id']."</td><td>".$row['customer']."</td><td>".$row['object']."</td><td>".$row['adress']."</td><td>".$row['lastdate']."</td><td>".$row['direction']."</td><td>".$t."</td><td>".$row['manager']."</td>
<td><form><button type=submit name='file' formaction='getfile.php' formmethod='post' value =".$row['file_adress'].">".substr($row['file_adress'],$start)."</button></form></td>
<td><form><button type=submit name='num' formaction='setover.php' formmethod='post' value =".$row['id'].">"."»"."</button></form></td></tr>";//$test = $row['customer'];

}



   


} catch (Exception $e) {
   echo 'Houston we have a problem: ('.$e->getCode().') '.$e->getMessage();
}


echo "
</table>
</div>
     ";

}//endif

else
{

$SO2 = 0;

if (isset($_POST['sortorder2']))
{	
	$SO2 = $_POST['sortorder2'];
}

$D2 ="";
if (isset($_POST['DESC2']) && ($_POST['sort2'] == $_POST['DESC2']) && ($SO2 == 0))
{
	$D2 = "DESC";
	$SO2 = 1;
}
else
{
	$SO2 = 0;
}

echo "
<h2 style='color:#000000'> Завершенные </h2>

<table border='1px'  cellspacing='0' cellpadding='1'>
<form action='download.php' method='post'>
<tr>

	<td><button type=submit name='sort2' value='1' style='width:100%'>#</button></td>
	<td><button type=submit name='sort2' value='2' style='width:100%'>Заказчик</button></td>
	<td><button type=submit name='sort2' value='3' style='width:100%'>Объект</button></td>
	<td><button type=submit name='sort2' value='4' style='width:100%'>Адрес</button></td>
	<td><button type=submit name='sort2' value='5' style='width:100%'>Дата загрузки документа</button></td>
	<td><button type=submit name='sort2' value='6' style='width:100%'>Этап</button></td>
	<td><button type=submit name='sort2' value='7' style='width:100%'>Тип</button></td>
	<td><button type=submit name='sort2' value='8' style='width:100%'>Менеджер</button></td>
	<td><center>Скачать</center></td>
<input name='DESC2' hidden value=".$_POST['sort2'].">
<input name='sortorder2' hidden value=".$SO2.">

</tr>
</form>
	";

try {

$conn = new PDO("mysql:host=localhost;dbname=test", "root", "admin");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->exec("SET NAMES cp1251"); 
  if (!$conn) 
  { 
    echo "<p>К сожалению, не доступен сервер mySQL</p>"; 
    //exit(); 
  } 
$type = array(
	   1 => "Заявка",
	   2 => "Тех. задание",
	   3 => "Спецификация",
	   4 => "Смета",
	   5 => "Коммерческое предложение",
	   6 => "Договор",
	   7 => "Наряд задание",
	   8 => "Акт выполненных работ"
	);
$location = "C:/apache/localhost/www/files/";
$start = strlen($location);

if (!$_POST['sort2'])
	{ $sort2=0;}
else
	{ $sort2=$_POST['sort2'];}

switch($sort2)
{
	case 0:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by lastdate DESC;");
		break;
	case 1:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by id ".$D2.";");
		break;
	case 2:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by customer ".$D2.";");
		break;
	case 3:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by object ".$D2.";");
		break;
	case 4:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by adress ".$D2.";");
		break;
	case 5:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by lastdate ".$D2.";");
		break;
	case 6:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by direction ".$D2.";");
		break;
	case 7:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by type ".$D2.";");
		break;
	case 8:
		$stat = $conn->query("Select * from docs where status = 2 ".$search." order by manager ".$D2.";");
		break;
}
		


while ($row = $stat->fetch())
{
	$t = $type[$row['type']];
	echo"<tr><td>".$row['id']."</td><td>".$row['customer']."</td><td>".$row['object']."</td><td>".$row['adress']."</td><td>".$row['lastdate']."</td><td>".$row['direction']."</td><td>".$t."</td><td>".$row['manager']."</td>
<td><form><button type=submit name='file' formaction='getfile.php' formmethod='post' value =".$row['file_adress'].">".substr($row['file_adress'],$start)."</button></form></td></tr>";//$test = $row['customer'];

}


   


} catch (Exception $e) {
   echo 'Houston we have a problem: ('.$e->getCode().') '.$e->getMessage();
}


echo "
</table>
</div>";
}//endelse
?>

</body>
</html>
