<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "question";
 
// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
 
$qid=array();

for($x=1;$x<100;$x+=10)
{
      $qid[]=mt_rand($x,$x+9);
}

$qidstr=implode(',',$qid);

//echo $qidstr;

$tab=$_GET['chapter'];

$sql = "SELECT question,opA,opB,opC,opD,answer FROM ".$tab." WHERE id IN ($qidstr)";

//echo $sql;

$responce=array();

$obq=array();

$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
     $responce[]=$row;
}

echo json_encode($responce);
$conn->close();
?>