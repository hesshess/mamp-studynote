<? require_once('connect.php');?>
<?
echo $_POST['id'];
settype($_POST['id'], 'integer');
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
    'name'=>mysqli_real_escape_string($conn, $_POST['name']),
    'profile'=>mysqli_real_escape_string($conn, $_POST['profile'])
);

$sql = "
UPDATE category
    SET
    name = '{$filtered['name']}', 
    profile = '{$filtered['profile']}'
    WHERE
        id = '{$filtered['id']}'
";
die($sql);
$result = mysqli_query($conn,$sql);
if(!$result){
echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요'; 
error_log(mysqli_error($conn));
}else {
    header('Location: category.php');
}
?>