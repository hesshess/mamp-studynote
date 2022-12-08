<?
$conn = mysqli_connect('localhost:3306', 'root', '0000', 'tutorials'); 

$sql = "SELECT * FROM topic"; 

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){;
echo '<h1>'.$row['title'].'</h1>';
echo $row['description'];
}
?>