<?php //data login localhost $localhost='localhost'; $db_user='root'; $db_pass='toor'; $db_name='test';
$imagename = mysql_real_escape_string($_FILES["image"]["name"]);    
$imagedate = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
$imagetype = mysql_real_escape_string($_FILES["image"]["type"]);

if(isset($_POST["submit"])) {
    if(substr($imagetype,0,5) == "image")
{
//connect
$db=new MySQLi($localhost,$db_user,$db_pass,$db_name);
//prepare
$query=$db->prepare("INSERT INTO `test`(imagename,imagedate) VALUES (?,?)");
//bind_param
$query->bind_param('ss',$imagename,$imagedate);
$query->execute();
echo 'good';
}