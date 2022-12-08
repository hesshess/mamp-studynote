<?
require_once('lib/print.php');
require_once('view/top.php');
?>
  
 <?
printList()
    ?>
</ol>
<a href="create.php">create</a>
<? if(isset($_GET['id'])){
?>
<a href="update.php?id=<?=$_GET['id']?>">update</a>
<? } ?>


<form action="update_process.php" method="post">
  <input type="hidden" name="old_title" value="<?=$_GET['id']?>">
  <p>
    <input type="text" name="title" placeholder="Title" value="<? printTitle();?>">
  </p>
  <p>
<textarea name="description" placeholder="Description"><? printDescription();?></textarea>
  </p>
  <p> 
<input type="submit"> 
  </p>


</form>
<?
require('view/bottom.php');
?>