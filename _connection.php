<?php
include ("_dbconnect.php");
$showAlert = false;
    $aname = $_POST["firstname"];
    $a2name = $_POST["lastname"];
    $aemail = $_POST["email"];
    $acontact = $_POST["number"];
    $asession = $_POST["session"];
    $aid = $_POST["id"];
    $acompany = $_POST['industry'];
    $atitle = $_POST['position'];
if(isset($_POST['submit']))
{
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;
    move_uploaded_file($tempname,$folder);

    $exists = false; 
    $sql = "select * from Alumni where aid = '$aid'";
    $result = mysqli_query($conn,$sql);
    $count_id = mysqli_num_rows($result);


    if($count_id==0 )
    {
        $stmt = $conn->prepare("INSERT INTO Alumni(aid, a_image, aname, a2name, aemail, acontact, asession, acompany, atitle) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssisss",$aid,$folder,$aname,$a2name,$aemail,$acontact,$asession,$acompany,$atitle);
        $stmt->execute();
        // echo "Submit Successfully. Thank You!";
        $stmt->close();
        $conn->close();
        $showAlert = true;
    }
    else 
    {
        if($count_id>0)
        {
            echo '<script>
            window.location.href="signup.php";
            alert("THIS ID ALREADY EXISTS"); </script>';
        }
    }
}
if($showAlert==true){ 
    echo '
    <div class="alert alert-success" role="alert">
        Submit Sucessfullly. Thanks!
      </div>';
    }

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;
    // echo $folder;
    move_uploaded_file($tempname,$folder);
    echo "<img src= '$folder' height='100px' width='100px'>";
?>