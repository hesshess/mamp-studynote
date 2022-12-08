<? require_once('connect.php');?>
<?
$sql = "SELECT * FROM category";
$result=mysqli_query($conn, $sql);
$select_form = '<select name="category_id" required>';
while($row = mysqli_fetch_array($result)){
$select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
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
<form action="process_create.php" method="post">
  <p><label for="category_id">카테고리를 선택하세요</label><?=$select_form?></p>
    <p><label for="title">글제목</label><input type="text" name="title" required placeholder="title"></p>
    <p>
     <label for="centent">글내용</label><textarea name="content" required placeholder="content"></textarea>
    </p>
    <p><label for="writer">작성자 by</label><input type="text" name="writer" required placeholder="writer"></p>
    <p><input type="submit" value="글등록"></p>
</form>
</body>
</html>