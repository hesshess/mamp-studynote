<? require_once('connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>forum</title>
</head>
<body> 
  <h1><a href="index.php">게시판</a></h1>
  <p><a href="index.php">글목록</a></p>
  <table border=1>
    <tr>
      <td>id 글의 category_id와 동일</td>
      <td>카테고리명</td>
      <td>설명</td>
      <td></td>
      <?
      $sql = "SELECT *FROM category";
      $result=mysqli_query($conn, $sql);
      while($row = mysqli_fetch_array($result)){
        $filtered = array(
        'id'=>htmlspecialchars($row['id']),
        'name'=>htmlspecialchars($row['name']),
        'profile'=>htmlspecialchars($row['profile'])
      );
        ?>
        <tr>
        <td><?=$filtered['id']?></td>
        <td><?=$filtered['name']?></td>
        <td><?=$filtered['profile']?></td>
        <td><a href="category.php?id=<?=$filtered['id']?>">update</a></td>
        <td><form action="process_delete_category.php" method="post">
          <input type="hidden" name="id" value="<?=$_GET['id']?>">
          <input type="submit" value="delete" onclick="if(!confirm('Are you sure?')){return false;}">
        </form></td>
        <?
      }
      
      ?>
      </tr>
    </table>
    <?
      $escaped = array(
        'name'=>'',
        'profile'=>''
      );
      $label_submit = '새 카테고리 생성';
      $form_action = 'process_create_category.php';
      $form_id = '';
      if(isset($_GET['id'])){ 
      $filtered_id= mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'int');
      $sql = "SELECT * FROM category WHERE id = {$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
        $escaped['name'] = htmlspecialchars($row['name']);
        $escaped['profile'] = htmlspecialchars($row['profile']);
        $label_submit = "카테고리 업데이트";
        $form_action = 'process_update_category.php';
        $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
      }
      ?>
     
  <form action="<?=$form_action?>" method="post" onsubmit="if(!confirm('Are you sure?')){return false;}">
      <p><label for="name">카테고리 이름</label><input type="text" name="name" required placeholder="카테고리명" value="<?=$escaped['name']?>"></p>
      <p><label for="profile">카테고리 설명</label><textarea name="profile" required placeholder="설명"><?=$escaped['profile']?></textarea></p>
      <p><input type="submit" value="<?=$label_submit?>"></p>
    </form> 
    
</body>
</html> 