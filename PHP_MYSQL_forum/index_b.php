<? require_once('connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forum</title>
</head>
<body> 
  <h1><a href="index.php">게시판</a></h1>
  <p><a href="category.php">카테고리 목록보기 & 추가</a>&nbsp;
  <a href="create.php">글 작성</a></p>
<?

//각페이지의 게시물번호
$cnt = 1;

//전체 게시물 개수
$sql_query = "SELECT * FROM post ORDER BY id desc";
$result = mysqli_query($conn, $sql_query);
$num_rows = mysqli_num_rows($result);

//한페이지의 데이터수
$list_num = 5;

//한화면의 블럭수
$page_num = 3; 

//현재페이지값 없으면 첫페이지로
$page = isset($_GET['page']) ? $_GET['page'] : 1;

//전체 페이지수 = 전체데이타 / $list_num
$total_page = ceil($num_rows / $list_num);

//전체 블럭수 = 전체페이지/ $page_num
$total_block = ceil($total_page/ $page_num);

//현재 블럭 번호 = 현재페이지번호 / 블럭당 페이지수
$now_block = ceil($page/ $page_num);

//블럭당 시작 페이지 번호 = (해당글의 블럭번호 -1)*블럭당페이지수+1
$start_pageNum = ($now_block -1) * $page_num +1;

//데이터가 0개인경우
if($start_pageNum == 0){
  $start_pageNum =1;
};

//블럭당 마지막 페이지 번호 = 현재 블럭 번호 *블럭당 페이지수 
$end_pageNum = $now_block * $page_num;

//마지막 페이지번호가 전체 페이지를 넘지 않도록
if($end_pageNum > $total_page){
  $end_pageNum = $total_page;
};

//시작번호 = (현재페이지번호-1) *페이지당 보여질 데이타 수 
$start = ($page-1)* $list_num;

//글번호
$cnt = $start+1;

//기존 쿼리에 페이지 개념을 도임 limit
// $sql_query_l= "SELECT * FROM post ORDER BY id desc LIMIT ".$start.",".$list_num." ";
// $result = mysqli_query($conn, $sql_query_l);

?>

  <table border=1>
    <tr>
      <td>카테고리</td>
      <td>idx</td>
      <td>글제목</td>
      <td>글내용</td>
      <td>작성시간</td>
      <td>작성자</td>
      <?
      $sql = "SELECT p.id, p.title, p.content, p.created, p.writer, c.name FROM post p, category c WHERE p.category_id = c.id LIMIT ".$start.",".$list_num." ";
      $result=mysqli_query($conn, $sql);
      while($row = mysqli_fetch_array($result)){
        $filtered = array(
        'id'=>htmlspecialchars($row['id']),
        'title'=>htmlspecialchars($row['title']),
        'content'=>htmlspecialchars($row['content']),
        'created'=>htmlspecialchars($row['created']),
        'writer'=>htmlspecialchars($row['writer']),
        'name'=>htmlspecialchars($row['name']),
       
      );
        ?>
        <tr>
        <td><?=$filtered['name']?></td>
        <td><?=$filtered['id']?></td>
        <td><?=$filtered['title']?></td>
        <td><?=$filtered['content']?></td>
        <td><?=$filtered['created']?></td>
        <td><?=$filtered['writer']?></td>
        <td><a href="update.php?id=<?=$filtered['id']?>">update</a></td>
        <td><form action="process_delete.php" method="post">
          <input type="hidden" name="id" value="<?=$filtered['id']?>">
          <input type="submit" value="delete" onsubmit="if(!confirm('Are you sure?')){return false;}">
        </form></td>
        <?
       $cnt++;
      }
      
     echo "</tr></table>";

    //페징 프론트 작업
    echo "<p>";
    //이전페이지
    if($page <=1){
      echo"<a href='index.php?page=1'>이전</a>";

    }else{
      echo"<a href='index.php?page=".($page-1)."'>이전</a>";
    }
    //페이지 번호 출력
    for($p = $start_pageNum; $p <= $end_pageNum; $p++){
      echo"<a href='index.php?page=".$p."'>".$p."</a>";
    }


    //다음페이지
    if($page >= $total_page){
      echo"<a href='index.php?page=".$total_page."'>다음</a>";

    }else{
      echo"<a href='index.php?page=".($page+1)."'>다음</a>";
    }
    echo "</p>";
    ?>
</body>
</html> 