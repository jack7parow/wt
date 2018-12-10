<!doctype html>
<html>
<body>
<style>
table th,td{
border:1px solid black;
background-color:grey;
text-align:center;
border-collapse:collapse;
}
table{margin:auto;}
</style>
<?php
$sn="localhost";
$un="root";
$p="";
$db="weblab";
$a=[];
$conn=mysqli_connect($sn,$un,$p,$db);
if($conn->connect_error)
die("Connection failed" .$conn->connect_error);
$sql="SELECT * FROM student";
$result=$conn->query($sql);
echo"<br>";
echo"<center>Before sorting</center>";
echo"<table border='2'>";
echo"<tr>";
echo"<th>USN</th><th>NAME</th><th>ADDRESS</th></tr>";
if($result->num_rows>0)
{
while($row=$result->fetch_assoc())
{
echo"<tr>";
echo"<td>".$row["usn"]."</td>";
echo"<td>".$row["name"]."</td>";
echo"<td>".$row["addr"]."</td></tr>";
array_push($a,$row["usn"]);
}
}
else
echo "table is empty";
echo "</table>";
$n=count($a);
$b=$a;
for($i=0;$i<($n-1);$i++)
{
$pos=$i;
for($j=$i+1;$j<$n;$j++)
if($a[$pos]>$a[$j])
{
$pos=$j;
}
if($pos!=$i)
{
$temp=$a[$i];
$a[$i]=$a[$pos];
$a[$pos]=$temp;
}
}
$c=[];
$d=[];
$result=$conn->query($sql);
if($result->num_rows>0)
{
while($row=$result->fetch_assoc())
{
for($i=0;$i<$n;$i++)
{
if($row["usn"]==$a[$i])
{
$c[$i]=$row["name"];
$d[$i]=$row["addr"];
}
}
}
}
echo"<br>";
echo"<center>After sorting</center>";
echo"<table border='2'>";
echo"<tr>";
echo"<th>USN</th><th>NAME</th><th>ADDRESS</th></tr>";
for($i=0;$i<$n;$i++)
{
echo"<tr>";
echo"<td>".$a[$i]."</td>";
echo"<td>".$c[$i]."</td>";
echo"<td>".$d[$i]."</td>";
}
echo"</table>";
$conn->close();
?>
</body>
</html>