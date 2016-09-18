<html>
<head>
	<title>Загрузка нового документа</title>
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
  font: 20px Georgia;
  vertical-align: middle ;
 
}
h3{
  color:#000000;
  font: 30px Georgia;
 
}

</style>
</head>

<body>
<header>
<div id="header">

		<h1>Загрузка нового документа</h1>
</div>
</header>
<br><br><br><br>

<div>
<form action='DocsExplorer.php' method=post>
	<button name='sort' value=1 style='background:url(sample-main.jpg); height:40px; position:absolute; top:57px;'><h2 style=" line-height:3px"> Назад </h2></button>	
</form>

<h3>Загрузчик</h3>

<div>
<form action="upload.php" method="post" enctype="multipart/form-data">
<table>
<tr><td>Выберете тип загружаемого документа :</td><td><select name="doctype" required>
    <option></option>
    <option value="1">Заявка</option>
    <option value="2">Тех. задание</option>
    <option value="3">Спецификация</option>
    <option value="4">Смета</option>
    <option value="5">Коммерческое предложение</option>
    <option value="6">Договор</option>
    <option value="7">Наряд задание</option>
    <option value="8">Акт выполненных работ</option>
   </select></td>

</tr>
<tr><td>Укажите статуc документа :</td><td><select name="status" required>
    
    <option></option>
    <option value="1">Новый</option>
    <option value="2">Завершенный</option>
   </select></td></tr>
<tr><td>Введите имя заказчика     :</td><td> <input type=text name="customer"> </td></tr>
<tr><td>Введите название объекта  :</td><td> <input type=text name="object"> </td></tr>
<tr><td>Введите адресс объекта    :</td><td> <input type=text name="adress"> </td></tr>
<tr><td>Введите этап работы       :</td><td> <input type=text name="direction"> </td></tr>
<tr><td>Имя загрузившего документ  :</td><td> <input type=text name="manager"> </td></tr>
<tr><td>Выберете загружаемый документ :</td><td><input type="FILE" name="filename" required></td>
</tr>
</table>
<br>
<button type=submit value=Загрузить style="height:50px"><p style='font-size: 1.5em;  line-height:5px ;'>Загрузить</p></button>
</form>
</div>
</body>
</html>