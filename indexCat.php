<? require_once('connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forum</title>
</head>
<body> 
  <h1><a href="index.php">게시판</a></h1>
  <p><a href="category.php">카테고리 수정</a>&nbsp;
  <a href="create.php">글 작성</a></p>
<?
$list_num = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1)* $list_num;
$category_id='';

//기존 쿼리에 페이지 개념을 도임 limit
$sql_noCat_withLimit = "SELECT p.id, p.title, p.content, p.created, p.writer, c.name FROM post p, category c WHERE p.category_id = c.id LIMIT " . $start . ",".$list_num." ";
$sql_noCat_noLimit = "SELECT p.id, p.title, p.content, p.created, p.writer, c.name FROM post p, category c WHERE p.category_id = c.id";

$sql_c = "SELECT * FROM category";
$result_c=mysqli_query($conn, $sql_c);
$select_form = '<form method="GET" action="index.php"><select name="category_id"><option value="" disabled selected>---해당 카테고리글만 보고싶다면?---</option>';
while($row = mysqli_fetch_array($result_c)){
$select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
$select_form .= '</select><input type="submit" value="선택"></form>';

$sql_categorized='';
$sql_categorized_noLimit='';
if(isset($_GET['category_id'])){
  $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
  $sql_categorized = "SELECT p.id, p.title, p.content, p.created, p.writer, c.name 
  FROM post p, category c 
  WHERE p.category_id = c.id AND category_id='$category_id'
  LIMIT " . $start . ",".$list_num." ";

  $sql_categorized_noLimit = "SELECT p.id, p.title, p.content, p.created, p.writer, c.name 
  FROM post p, category c 
  WHERE p.category_id = c.id AND category_id='$category_id'
";
}

echo $select_form;

echo "<table border=1>";
echo "  <tr>";
echo "    <td>카테고리</td>";
echo "    <td>idx</td>";
echo "    <td>글제목</td>";
echo "    <td>글내용</td>";
echo "    <td>작성시간</td>";
echo "    <td>작성자</td>";


$cnt = 1;

//전체 게시물 개수
$sql = if(isset($_GET['category_id'])){} ? $sql_categorized_noLimit : $sql_noCat_noLimit;
$result=mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
print_r($num_rows);

// 전체 게시물 갯수
// 페이지 번호
// 1페이지당 노출 갯수

//한페이지의 데이터수
//$list_num = 5;

//한화면의 블럭수
//$page_num = 3; 

//현재페이지값 없으면 첫페이지로
//$page = isset($_GET['page']) ? $_GET['page'] : 1;

//전체 페이지수 = 전체데이타 / $list_num
$total_page = ceil($num_rows / $list_num);

//전체 블럭수 = 전체페이지/ $page_num
//$total_block = ceil($total_page/ $page_num);

//현재 블럭 번호 = 현재페이지번호 / 블럭당 페이지수
//$now_block = ceil($page/ $page_num);

//블럭당 시작 페이지 번호 = (해당글의 블럭번호 -1)*블럭당페이지수+1
//$start_pageNum = ($now_block -1) * $page_num +1;

//데이터가 0개인경우
if($total_page== 0){
  $total_page =1;
};

//블럭당 마지막 페이지 번호 = 현재 블럭 번호 *블럭당 페이지수 
//$end_pageNum = $now_block * $page_num;

//마지막 페이지번호가 전체 페이지를 넘지 않도록
//if($end_pageNum > $total_page){$end_pageNum = $total_page};

//시작번호 = (현재페이지번호-1) *페이지당 보여질 데이타 수 
//$start = ($page-1)* $list_num;

//글번호
$cnt = $start+1;

      while($row = mysqli_fetch_array($result)){
        $filtered = array(
        'id'=>htmlspecialchars($cnt),
        'title'=>htmlspecialchars($row['title']),
        'content'=>htmlspecialchars($row['content']),
        'created'=>htmlspecialchars($row['created']),
        'writer'=>htmlspecialchars($row['writer']),
        'name'=>htmlspecialchars($row['name']),
       
      );
        
       echo" <tr>
        <td>".$filtered['name']."</td>
        <td>".$filtered['id']."</td>
        <td>".$filtered['title']."</td>
        <td>".$filtered['content']."</td>
        <td>".$filtered['created']."</td>
        <td>".$filtered['writer']."</td>
        <td><a href=\"update.php?id=<?=".$filtered['id']."?>\">update</a></td>
        <td><form action=\"process_delete.php\" method=\"post\">
          <input type=\"hidden\" name=\"id\" value=\"".$filtered['id']."\">
          <input type=\"submit\" value=\"delete\" onsubmit=\"if(!confirm('Are you sure?')){return false;}\">
        </form></td>";
        
       $cnt++;
      }
      
     echo "</tr></table>";
     $category_url = sprintf("&category_id=%d", $category_id);
     echo $category_url;

    //페이징 프론트 작업
    echo "<p>";
  
    isset($category_id){
    //이전페이지
    if($page <=1){
      echo"<a href='index.php?page=1".$category_url."'>이전</a>";

    }else{
      echo"<a href='index.php?page=".($page-1).$category_url."'>이전</a>";
    }
    //페이지 번호 출력
    for($p = 1; $p <= $total_page; $p++){
      echo"<a href='index.php?page=".$p.$category_url."'>".$p."</a>";
    }


    //다음페이지
    if($page >= $total_page){
      echo"<a href='index.php?page=".$total_page.$category_url."'>다음</a>";

    }else{
      echo"<a href='index.php?page=".($page+1).$category_url."'>다음</a>";
    }
    echo "</p>";}
    else{

    }
    ?>
</body>
</html> 