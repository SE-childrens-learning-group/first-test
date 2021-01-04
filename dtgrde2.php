<?php
function myadd($al,$ar,$bl,$br,$cl,$cr)
{
   do{
    $a=mt_rand($al,$ar);
    $b=mt_rand($bl,$br);
    $qstr=$a."+".$b."="; 
    $result=$a+$b;
  }
  while($a+$b>$cr||$a+$b<$cl||$a<$b);
  return array("q"=>$qstr,"r"=>$result);
}

function mysub($al,$ar,$bl,$br,$cl,$cr)
{
   do{
    $a=mt_rand($al,$ar);
    $b=mt_rand($bl,$br);
    $qstr=$a."-".$b."="; 
    $result=$a-$b;
  }
  while($result>$cr||$result<$cl||$a<$b);
  return array("q"=>$qstr,"r"=>$result);
}

function mymul($al,$ar,$bl,$br,$cl,$cr)
{
   do{
    $a=mt_rand($al,$ar);
    $b=mt_rand($bl,$br);
    $qstr=$a."×".$b."="; 
    $result=$a*$b;
  }
  while($a+$b>$cr||$a+$b<$cl||$a<$b);
  return array("q"=>$qstr,"r"=>$result);
}

function mydev($al,$ar,$bl,$br,$cl,$cr)
{
   do{
    $c=mt_rand($cl,$cr);
    $b=mt_rand($bl,$br);
    $a=$b*$c;
  }
  while($a>$ar||$a<$al);
  $qstr=$a."÷".$b."=";
  return array("q"=>$qstr,"r"=>$c);
}
function myinsert($id,$qstr,$result,$ans,$cl,$cr)
{
     $op=[0,0,0,0];
     $i=0;
     $op[$ans]=$result;
     while($i<4)
     {
        if($i==$ans)
          $i++;
        else
        {
           $c=mt_rand($cl,$cr);
           if(array_search($c,$op)===false)
           {
             $op[$i++]=$c;
           }
        }
    }
    $sql="INSERT INTO `question`.`grade2` (`id`, `question`, `opA`, `opB`, `opC`, `opD`, `answer`) VALUES ($id,'$qstr', $op[0], $op[1], $op[2], $op[3], $ans)";
    echo $sql;
    return $sql;
}

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "question";

$conn = new mysqli($servername, $username, $password,$dbname);
$sql ="CREATE TABLE `question`.`grade2` (
		`id` INT NOT NULL,
		`question` VARCHAR(45) NOT NULL,
		`opA` VARCHAR(45) NOT NULL,
		`opB` VARCHAR(45) NOT NULL,
		`opC` VARCHAR(45) NOT NULL,
		`opD` VARCHAR(45) NOT NULL,
		`answer` VARCHAR(45) NOT NULL,
		PRIMARY KEY(`id`))
		ENGINE = InnoDB
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_bin;";
$conn->query($sql);
$question=[];
$id=0;
while($id<30)
{  
  $qu=myadd(10,99,10,99,10,99);
  if(array_search($qu['q'],$question)==false)
  {  
     $question[]=$qu['q'];
     $ans=$id%4;
     $id++;
     $sql=myinsert($id,$qu['q'],$qu['r'],$ans,10,99);
     $conn->query($sql);   
  }
}
while($id<60)
{  
  $qu=mysub(10,99,10,99,10,99);
  if(array_search($qu['q'],$question)==false)
  {  
     $question[]=$qu['q'];
     $ans=$id%4;
     $id++;
     $sql=myinsert($id,$qu['q'],$qu['r'],$ans,10,99);
     $conn->query($sql);
  }
}
while($id<80)
{  
  $qu=mymul(1,9,1,9,1,99);
  if(array_search($qu['q'],$question)==false)
  {  
     $question[]=$qu['q'];
     $ans=$id%4;
     $id++;
     $sql=myinsert($id,$qu['q'],$qu['r'],$ans,1,99);
     $conn->query($sql);
  }
}
while($id<100)
{  
  $qu=mydev(1,99,1,9,1,9);
  if(array_search($qu['q'],$question)==false)
  {  
     $question[]=$qu['q'];
     $ans=$id%4;
     $id++;
     $sql=myinsert($id,$qu['q'],$qu['r'],$ans,1,9);
     $conn->query($sql);
  }
}