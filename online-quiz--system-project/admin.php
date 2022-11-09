<?php
    // Initialize the session
    session_start();

    //connecting server
    //include("connect.php");
    require_once('connect.php');

    //check if session already started or not
    if(isset($_SESSION['idAdmin'])){
        //check if data available in database or not
        if ($_SESSION['idAdmin'] == 0) {
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/index.php");
            //header('location: index.php');
        }
        else{

            //Code for Lecturer Registration 
            if(isset($_POST['submit']))
            {
                $fname=ucfirst($_POST['fname']); //ucfirst() function converts the first character of a string to uppercase
                $lname=ucfirst($_POST['lname']);
                $email=$_POST['email'];
                $password=$_POST['password'];
                $enc_password=md5($password); //md5 encrypt the password

                //check exist email from database
                $sql=mysqli_query($connection,"SELECT id FROM lecturers WHERE email='$email'");
                
                if(!$sql)
                {
                //check if database is empty then first step, insert data
                    $data="INSERT INTO lecturers(fname,lname,email,password)
                                VALUES('$fname','$lname','$email','$enc_password')";
                    if(mysqli_query($connection,$data))
                    {
                        echo "<script>alert('Register successfully');</script>";
                    }
                    else{
                        echo "<script>alert('Not successfully register');</script>";
                    }

                } else {
                    $row=mysqli_num_rows($sql);
                    //return the number of rows present in the result set
                    if($row>0)
                    {
                    //check if exists email find out.
                        echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
                    }
                    else{
                        $msg=mysqli_query($connection,"INSERT INTO lecturers(fname,lname,email,password)
                                            VALUES('$fname','$lname','$email','$enc_password')");

                        if($msg)
                        {
                            echo "<script>alert('Register successfully');</script>";
                        }
                    }
                }
            }


            //Code for Student Registration 
            if(isset($_POST['submitStd']))
            {
                $fname=ucfirst($_POST['fname']); //ucfirst() function converts the first character of a string to uppercase
                $lname=ucfirst($_POST['lname']);
                $email=$_POST['email'];
                $password=$_POST['password'];
                $enc_password=md5($password); //md5 encrypt the password

                //check exist email from database
                $sql=mysqli_query($connection,"SELECT id FROM students WHERE email='$email'");
                
                if(!$sql)
                {
                //check if database is empty then first step, insert data
                    $data="INSERT INTO students(fname,lname,email,password)
                                VALUES('$fname','$lname','$email','$enc_password')";
                    if(mysqli_query($connection,$data))
                    {
                        echo "<script>alert('Register successfully');</script>";
                    }
                    else{
                        echo "<script>alert('Not successfully register');</script>";
                    }

                } else {
                    $row=mysqli_num_rows($sql);
                    //return the number of rows present in the result set
                    if($row>0)
                    {
                    //check if exists email find out.
                        echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
                    }
                    else{
                        $msg=mysqli_query($connection,"INSERT INTO students(fname,lname,email,password)
                                            VALUES('$fname','$lname','$email','$enc_password')");

                        if($msg)
                        {
                            echo "<script>alert('Register successfully');</script>";
                        }
                    }
                }
            }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz System</title>
    <!-- icon in tab -->
    <link rel="icon" href="assets/img/nepal.png">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body onload="display1()">
	<main>
        <div class="intro" style="height: 70px;">
            <h2>Online Quiz System</h2>
            <div><a href="logout.php" class="logout">Logout</a></div>
        </div>
        <div class="wrapAll" style="left: 50px;">
            <div class="contentHead">
                <div class="optionlist">
                    <span style="border-bottom: 1px solid; padding: 4px; color: #1C2833;">
                        Manage
                    </span>
                    <br><br>
                    <div onclick="display2()" style="cursor: pointer;">
                        <img src="assets/img/lec.png" alt="reg" width="40px" height="40px">
                        <span id="lecturer">Lecturer</span>
                    </div>
        
                    <div onclick="display3()" style="cursor: pointer;">
                        <img src="assets/img/std.png" alt="log" width="40px" height="40px">
                        <span id="student">Student</span>
                    </div>
                </div>
            </div>
            <div id="lecturer-wrap">
                <p class="bottomline">Edit Lecturer Details</p>
                <br>
                <div onclick="display4()" style="cursor: pointer;" class="edit" >
                    <span>Add/Delete</span>
                </div>

            </div>
            <div id="student-wrap">
                <p class="bottomline">Edit Student Details</p>
                <br>
                <div onclick="display5()" style="cursor: pointer;" class="edit">
                    <span>Add/Delete</span>
                </div>
            </div> 
        </div>
        <br>
        <div class="wrapSide" style="position: relative;
                                        left: 50px;
                                        margin-bottom: 20px;
                                        font-size: larger;
                                        display: inline-block;
                                        border: 1px solid;
                                        padding: 40px 90px 30px 50px;
                                        background: #727854;">
            <p class="bottomline">Details</p>
            
            <div id="lecturer-wrap2" class="inbox-container">
                <div class="inbox-child">
                    <p class="bottomline">Add Lecturer Details</p>
                    <form class="lecturer" action="" method="POST">
                        <p>First Name</p>
                        <input type="text" name="fname" value="" class="text" required>
                        <p>Last Name </p>
                        <input type="text" class="text" value="" name="lname"  required>
                        <p>Email Address </p>
                        <input type="email" class="text" value="" name="email" required>
                        <p>Password </p>
                        <input type="password" value="" name="password" required>
                        <div class="sign-up">
                            <input type="reset" value="Reset" class="pressButton">
                            <input type="submit" name="submit" value ="Submit" class="pressButton">
                        </div>
                    </form>
                </div>
                <div class="inbox-child">
                    <p class="bottomline">Delete Lecturer Details</p>
                    <form method="POST" action="">
                        <ul class="deleteDetails" style="list-style: none;">
                            <?php
                              $query1 = "SELECT * FROM lecturers";
                              $result = mysqli_query($connection,$query1);
                              $sn=1;
                              $nrow=mysqli_num_rows($result);
                              if(!($nrow>0)){
                                echo '<p>Lecturer Details Empty.<br>Please, add details.</p>';
                              }
                            while($lecturerData = mysqli_fetch_assoc($result)){
                                if(isset($_POST['del_submit']))
                                {
                                  $email=$_POST['del_submit'];
                                  $sql=mysqli_query($connection,"DELETE FROM lecturers WHERE email='$email'");
                                  if($sql){
                                      echo "<script>alert('Details Deleted successfully');</script>";
                                      header("Refresh:0");//refresh after 0 seconds
                                  }
                                }
                                ?>
                            <li style="background: #cce5ff;
                                        color: darkblue;
                                        margin: 5px;
                                        padding:10px">
                                        <p><?php echo $sn.". Name: ".$lecturerData['fname']." ".$lecturerData['lname'];
                                            $email=$lecturerData['email']; echo "<br> Email: ".$email; $sn++;?>
                                        </p>
                                        <div class="delete">
                                            <button type="submit" name="del_submit" value="<?php echo $email; ?>" class="pressButton">Delete</button>
                                        </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </form>
                </div>
                
            </div>
            <div id="student-wrap2" class="inbox-container">
                <div class="inbox-child">
                    <p class="bottomline">Add Student Details</p>
                    <form class="student" action="" method="POST">
                        <p>First Name</p>
                        <input type="text" name="fname" value="" class="text" required>
                        <p>Last Name </p>
                        <input type="text" class="text" value="" name="lname"  required>
                        <p>Email Address </p>
                        <input type="email" class="text" value="" name="email" required>
                        <p>Password </p>
                        <input type="password" value="" name="password" required>
                        <div class="sign-up">
                            <input type="reset" value="Reset" class="pressButton">
                            <input type="submit" name="submitStd" value ="Submit" class="pressButton">
                        </div>
                    </form>
                </div>
                <div class="inbox-child">
                    <p class="bottomline">Delete Student Details</p>
                    <form method="POST" action="">
                        <ul class="deleteDetails" style="list-style: none;">
                            <?php
                              $query1 = "SELECT * FROM students";
                              $result = mysqli_query($connection,$query1);
                              $snStd=1;
                              $nrow=mysqli_num_rows($result);
                              if(!($nrow>0)){
                                echo '<p>Student Details Empty.<br>Please, add details.</p>';
                              }
                            while($studentData = mysqli_fetch_assoc($result)){
                                if(isset($_POST['del_submitStd']))
                                {
                                  $email1=$_POST['del_submitStd'];
                                  $sql1=mysqli_query($connection,"DELETE FROM students WHERE email='$email1'");
                                  if($sql1){
                                      echo "<script>alert('Details Deleted successfully');</script>";
                                      echo "<script type='text/javascript'>window.location.href=location.href;</script>";
                                  }
                                }
                                ?>
                            <li style="background: #cce5ff;
                                        color: darkblue;
                                        margin: 5px;
                                        padding:10px">
                                        <p><?php echo $snStd.". Name: ".$studentData['fname']." ".$studentData['lname'];
                                            $email1=$studentData['email']; echo "<br> Email: ".$email1; $snStd++;?>
                                        </p>
                                        <div class="delete">
                                            <button type="submit" name="del_submitStd" value="<?php echo $email1; ?>" class="pressButton">Delete</button>
                                        </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
	</main>
	<footer class="footer" style= "position: relative; top: 228px; background: #707080;text-align:center;padding:5px;">
        <div class="copyright">
            <p>&copy; Copyright <span id="year"></span>. All rights reserved</p>
        </div>
    </footer>

    <script type="text/javascript" src="assets/js/changeContent2.js"></script>
    <script type="text/javascript" src="assets/js/year.js"></script>
</body>
</html>

<?php 

        } //closing else 
    }// closing main-if
    else{
    //if session is not started then redirecting...
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/index.php");
        //header('location:index.php');
    }
?> 
