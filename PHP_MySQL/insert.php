<?

$conn = mysqli_connect("localhost:3306", "root", "0000", "tutorials");
$sql ="
INSERT INTO topic
(title, description, created)
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