<?php
$conn = mysqli_connect(
  'localhost:3306',
  'root',
  '0000',
  'tutorials');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WEB</title>
</head>
<body> 
  <h1><a href="index.php">WEB</a></h1>
  <p><a href="index.php">topic</a></p>
  <table border=1>
    <tr>
      <td>id</td>
      <td>name</td>
      <td>profile</td>
      <td></td>
      <?
      $sql = "SELECT *FROM author";
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
        <td><a href="author.php?id=<?=$filtered['id']?>">update</a></td>
        <td><form action="process_delete_author.php" method="post">
          <input type="hidden" name="id" value="<?=$filtered['id']?>">
          <input type="submit" value="delete">
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
      $label_submit = 'Create Author';
      $form_action = 'process_create_authot.php';
      $form_id = '';
      if(isset($_GET['id'])){ 
      $filtered_id= mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'int');
      $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
        $escaped['name'] = htmlspecialchars($row['name']);
        $escaped['profile'] = htmlspecialchars($row['profile']);
        $label_submit = "Update author";
        $form_action = 'process_update_authot.php';
        $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
      }
      ?>
     
  <form action="<?=$form_action?>" method="post" onsubmit="if(!confirm('Are you sure?')){return false;}">
      <p><input type="text" name="name" value="<?=$escaped['name']?>"></p>
      <p><textarea name="profile"placeholder="profile"><?=$escaped['profile']?></textarea></p>
      <p><input type="submit" value="<?=$label_submit?>"></p>
    </form>
</body>
</html> 