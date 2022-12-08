<? require_once('connect.php');?>
<?
settype($_POST['id'], 'integer');
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
);

$sql = "
DELETE
FROM post
WHERE category_id = {$filtered['id']}
";
mysqli_query($conn, $sql);

$sql = "
DELETE
    FROM category
    WHERE id = {$filtered['id']}";

$result = mysqli_query($conn,$sql);
if(!$result){
echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요'; 
error_log(mysqli_error($conn));
}else {
    header('Location: category.php');
}
?>