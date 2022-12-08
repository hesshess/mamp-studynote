<? require_once('connect.php');?>

<?
$sql ="
INSERT INTO post
(title, content, created)
VALUE(
    'MYSQL',
    'mysql is ...',
    NOW()
    )";

$result = mysqli_query($conn,$sql);
if(!$result){
echo mysqli_error($conn);    
}
?>