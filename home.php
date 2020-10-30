<?php
error_reporting(0);
$dbconn = pg_connect("host=localhost dbname=practice port=5432");
$rows = pg_copy_to($dbconn, "practice",'*');
$strings=3; // количество записей на странице
echo count($rows);
if ($rows%2!=0) {
    $pages = intval(count($rows) / $strings + 1);
} else {
    $pages = intval(count($rows) / $strings );
}
$page= $_GET["page"];
$content=array_chunk($rows,$strings);
if(empty($page)){
    $page=1;
    $pages--;
}
if ($strings==3){
    $pages--;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/styles/style.css">
    <title>home</title>
</head>
<body>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li>
            <?php
            if($page!=1){
                echo '<a class="page-link" href="home.php?page=',$page-1,'" tabindex="-1">Previous</a>';
            }else{
                echo '<a class="page-link" href="home.php?page=',$pages,'" tabindex="-1">Previous</a>';
            }
            echo "</li>";
            echo '<li class="page-item">';
            if($page!=$pages){
                echo '<a class="page-link" href="home.php?page=',$page+1,'" tabindex="-1">Next</a>';
            }else{
                echo '<a class="page-link" href="home.php?page=',1,'" tabindex="-1">Next</a>';
            }
            echo "</li>";
            ?>
    </ul>
</nav>
<table  class="table" border="2">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Email</th>
        <th scope="col">First name</th>
        <th scope="col">Last name</th>
        <th scope="col">Password</th>
        <th scope="col">Pos</th>
        <th scope="col">About</th>
        <th scope="col">Gender</th>
        <th scope="col">Invite</th>
        <th scope="col">Get massages</th>
    </tr>
    </thead>
     <tbody>
        <?php
            foreach ($content[$page-1] as $row){
                echo "<tr>";
                $str=explode('*',$row);
                foreach ($str as $strI){
                    echo "<td>",$strI,"</td>";
                }
                echo "</tr>";
            }
        ?>
     </tbody>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>