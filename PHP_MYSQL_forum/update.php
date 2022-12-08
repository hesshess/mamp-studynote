<? require_once('connect.php');?>
<?
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM post WHERE id={$filtered_id}";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$filtered= array(
  'id'=>htmlspecialchars($row['id']),
  'title'=>htmlspecialchars($row['title']),
  'content'=>htmlspecialchars($row['content']),
  'created'=>htmlspecialchars($row['created']),
  'writer'=>htmlspecialchars($row['writer']),
  'category_id'=>htmlspecialchars($row['category_id']));

$status = $filtered['category_id'];

$sql = "SELECT * FROM category";
$result=mysqli_query($conn, $sql);
$select_form = '<select name="category_id"  required>';

while($row = mysqli_fetch_array($result)){
  $rowId = $row['id'];

  if( $status == $rowId ){
    $select_form .= '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
  }else{
    $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  }

}
$select_form .= '</select>'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body> 
  <h1><a href="index.php">게시판</a></h1>

<form action="process_update.php" method="post">
    <input type="hidden" name="id" value="<?=$_GET['id']?>">

    <p><label for="category_id">카테고리를 다시 선택하세요</label><?=$select_form?></p>
    <p><input type="text" required name="title" value="<?=$filtered['title']?>"></p>
    <p>
        <textarea required name="content"><?=$filtered['content']?></textarea>
    </p>
    <p><input type="text" required name="writer" value=<?=$filtered['writer']?>></p>
    <p><input type="submit"></p>
</form>
</body>
</html>