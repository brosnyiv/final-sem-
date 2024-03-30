<?php include "head.php"; 
$id = $_GET['id'];

$conn = mysqli_connect("localhost","root","","mega");

$query = "select * from users where id=$id limit 1";
$result = mysqli_query($conn,$query);

foreach($result as $rslt){}

?>


    <div class="content">
        <div class="user_form">
            <form method="POST" action="">
                <label class="lb">Full Name</label><br>
                <input class="field" type="text" name="fullname" value="<?= $rslt['fullname'] ?>"><br>
                
                <label class="lb">Date of Birth</label><br>
                <input class="field" name="dob" type="date" value="<?= $rslt['dob'] ?>"><br>
                
                <label class="lb">Gender</label><br>
                <input class="rd" name ="gender" value="male" type="radio" <?php if($rslt['gender'] == "male"){echo "checked";}?> >Male<br>
                <input class="rd" name ="gender" value="female" type="radio" <?php if($rslt['gender'] == "female"){echo "checked";}?> >Female<br>
                
                <label class="lb">email</label><br>
                <input class="field" type="email" name="email" value="<?= $rslt['email'] ?>"><br>
                
                <label class="lb">Username</label><br>
                <input class="field" type="text" name="username" value="<?= $rslt['username'] ?>"><br>
                
                <label class="lb">Password</label><br>
                <input class="field" type="password" name="password" placeholder="Enter Password"><br>
                
                <label class="lb">Confirm Password</label><br>
                <input class="field" type="password" name="cpassword" placeholder="Confirm Password"><br>
                
                <input class="button" type="submit" name="edit" value="Edit"><br>
            </form>
        </div>

        <div class="user_table"></div>
    </div>

<?php include "footer.php";

$conn = mysqli_connect("localhost","root","","mega");

if(!$conn){
    die("Connection Failed:". mysqli_connect_error());
}


if(isset($_POST['edit'])){
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password =  $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password == "" || $password == null){
        $sql = "update users set fullname='$fullname', dob='$dob'
        ,gender='$gender', email='$email',username='$username'
        where id=$id ";
        $insert = mysqli_query($conn,$sql);
        
    }elseif($password == $cpassword){
        $sql = "update users set fullname='$fullname', dob='$dob'
        ,gender='$gender', email='$email',username='$username'
        ,password='$password' where id=$id ";
        $insert = mysqli_query($conn,$sql);
    }else{
        echo "passwords dont match";
    }

    if($insert){
        header("Location:viewusers.php");
    }

}


?>