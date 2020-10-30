<?php
error_reporting(0);
$email=$_POST['email'];
$fname=$_POST['firstname'];
$sname=$_POST['secondname'];
$pass=$_POST['pass'];
$cpass=$_POST['cpass'];
$pos=$_POST['pos'];
$ab=$_POST['ab'];
$sex=$_POST['sex'];

$target_dir = "loadedFiles/";
$target_file = $target_dir . basename($_FILES["rec"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if ($_FILES["rec"]["size"] > 500000) {
    $target_file="Have no photo";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $target_file="Have no photo";
    $uploadOk = 0;
}

if ($uploadOk){
    move_uploaded_file($_FILES["rec"]["tmp_name"], $target_file);
}



if (empty($target_file)){
    $target_file="Have no photo";
}
if (empty($_POST['mes'])){
    $mes=false;
}else{
    $mes=true;
}
$query= [
        'email'=>$email,
        "fname"=>$fname,
        "sname"=>$sname,
        "pass"=>$pass,
        "pos"=>$pos,
        "ab"=>$ab,
        "sex"=>$sex,
        "photo"=>$target_file,
        "mes"=>$mes,
];
$mail=  "his email : " . $email . "\n" .  "his First name : " . $fname . "\n" . "his Last name" . $sname . "\n" . "his position " . $pos . "\n";
    if (!empty($email) && !empty($fname) && !empty($sname)
        && !empty($pass) && !empty($pos) && !empty($sex)
        && ($pass==$cpass) && ctype_alpha($fname) && ctype_alpha($sname)){
        $result="You are welcome!";
}else{
    $result="Incorrect input data, please, try again ";
}
if ($result == "You are welcome!"){
    $ref="home.php?page=1";
    $label="Continue";
    $dbconn = pg_connect("host=localhost dbname=practice port=5432");
    $ins=pg_insert($dbconn ,'practice',$query);
    pg_close($dbconn);
    mail('test@mail.ru', 'New user', $mail,
        'From :prectice_Vasiyarov'); // здесть в первом аргументе напишите почту получателя а в последнем укажиет вашу почту


}else{
    $ref="index.html";
    $label="Try again";
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
    <title>result</title>
</head>
<body>
<div class="answer"  >
    <h1><?php echo $result; ?></h1>
    <form action="<?php echo $ref; ?>">
        <button type="submit" class="btn btn-primary"><?php echo $label; ?></button>
    </form>
</div>

</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>

