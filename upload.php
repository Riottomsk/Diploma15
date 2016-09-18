<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
    <meta charset="UTF-8">
	<style>
  	 a { 
    		text-decoration: none; /* Отменяем подчеркивание у ссылки */
   	   } 
 	</style>
</head>
<body>
<?php
try {



$conn = new PDO("mysql:host=localhost;dbname=test", "root", "admin");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->exec("SET NAMES cp1251"); 
  if (!$conn) 
  { 
    echo "<p>К сожалению, не доступен сервер mySQL</p>"; 
   // exit(); 
  } 
//$stat = $conn->query("Select customer from test where id=5;");
//$row = $stat->fetch();
//$test = $row['customer'];
//echo "$test<br>";




//$statement = $conn->query("INSERT INTO test VALUES (NULL,'Иван')");
   
//header("Location: newfiles.php");
if($_POST['doctype'])
{
	$dt=$_POST['doctype'];
	//echo $dt;
}
else
{
	echo "failure";
}
//echo 'OK';
if($_POST['status'])
{
	$st=$_POST['status'];
}   

if($_POST['customer'])
{
	$customer=$_POST['customer'];
}
else
{
	$customer="";
}

if($_POST['object'])
{
	$object=$_POST['object'];
}
else
{
	$object="";
}

if($_POST['direction'])
{
	$dir=$_POST['direction'];
}
else
{
	$dir="";
}

if($_POST['manager'])
{
	$manager=$_POST['manager'];
}
else
{
	$manager="";
}
if($_POST['adress'])
{
	$adress=$_POST['adress'];
}
else
{
	$adress="";
}
$data = time();
$location = "C:/apache/localhost/www/files/";
$filename = $_FILES['filename'];
 if($_FILES["filename"]["size"] > 1024*3*1024)
   {
     echo ("alert(Размер файла превышает три мегабайта)");
     exit;
   }

   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
  
	$fileadress = $location.$data.'.'.$_FILES["filename"]["name"];
     move_uploaded_file($_FILES["filename"]["tmp_name"], $fileadress);
   } else {
      echo("alert(Ошибка загрузки файла)");
   }

//echo 'OK';
header("Location: Docsexplorer.php");

$statement = $conn->query("INSERT INTO Docs VALUES (NULL,'$customer', '$object','$adress',NOW(),'$dir',$dt,$st,'$manager','$fileadress')");

} catch (Exception $e) {
    echo 'Houston we have a problem: ('.$e->getCode().') '.$e->getMessage();
}
?>
