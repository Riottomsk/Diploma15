<html>
<head>
	<title>Просмотр файлов в базе</title>
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

		<h1>Управление документами</h1>
</div>
</header>
<br><br><br>

<form>
<button type=submit name='file' formaction='newfiles.php' formmethod='post' value ="" style='background:url(sample-main.jpg); '><h2>Загрузить файл на сервер</h2></button>
<button type=submit name='sort' formaction='download.php' formmethod='post' value ="1" style='background:url(sample-main.jpg);'><h2>Посмотреть загруженные файлы</h2></button>
</form>

</body>

</html>