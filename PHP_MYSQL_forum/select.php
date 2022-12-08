<? require_once('connect.php');?>
<?

$sql = "SELECT * FROM post"; 

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){;
echo '<h1>'.$row['title'].'</h1>';
echo $row['content'];
}
?>