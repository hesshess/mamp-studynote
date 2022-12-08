<? require_once('connect.php');?>

<?
$sql_query = "SELECT * FROM post ORDER BY id desc";
$result = mysqli_query($conn, $sql_query);
$num_rows = mysqli_num_rows($result);
$list_num = 5;
$total_page = ceil($num_rows / $list_num);

$filtered = array(
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'content'=>mysqli_real_escape_string($conn, $_POST['content']),
    'category_id'=>mysqli_real_escape_string($conn, $_POST['category_id']),
    'writer'=>mysqli_real_escape_string($conn, $_POST['writer'])
);

$sql = "
INSERT INTO post
    (title, content, created, category_id, writer)
    VALUES(
        '{$filtered['title']}',
        '{$filtered['content']}',
        NOW(),
        '{$filtered['category_id']}',
        '{$filtered['writer']}'
        )
";

$result = mysqli_query($conn,$sql);
if(!$result){
echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요'; 
error_log(mysqli_error($conn));
}else {
    //header("Location: index.php?page=" . $total_page);
    header("Location: index.php");
}
?>