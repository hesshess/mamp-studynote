<? require_once('connect.php');?>
<?
settype($_POST['id'], 'integer');
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
'content'=>mysqli_real_escape_string($conn, $_POST['content']),
    'category_id'=>mysqli_real_escape_string($conn, $_POST['category_id']),
    'writer'=>mysqli_real_escape_string($conn, $_POST['writer'])
);

$sql = "
UPDATE post
    SET 
    title = '{$filtered['title']}', 
    content = '{$filtered['content']}',
    category_id = '{$filtered['category_id']}',
    writer = '{$filtered['writer']}'
    WHERE id = '{$filtered['id']}'
";

$result = mysqli_query($conn,$sql);
if(!$result){
echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요'; 
error_log(mysqli_error($conn));
}else {
    header('Location: index.php');
}
?>