<?php 
include 'connect.php';
session_start();

if(isset($_SESSION['id'])){
  //check if data available in database or not
    if ($_SESSION['id']==0) {
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/welcome.php");
        //header('location:welcome.php');
    }
    else
    {
        $query = "SELECT * FROM questions";
        $total_questions = mysqli_num_rows(mysqli_query($connection,$query));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="icon" href="assets/img/nepal.png">
</head>
<body>
    <div class="intro">
        <h4 style="margin-top:24px;">Online Quiz System</h4>
        
        <div><a href="logout.php" class="logout">Logout</a></div>
    </div>

    <main>
        <div class="container">
            <h2>Knowledge Test</h2>
            <p>
                This is a multiple choice quiz to test your Knowledge.
            </p>
            <ul>
                <li><strong>Number of Questions:</strong><?php echo $total_questions; ?> </li>
                <li><strong>Type:</strong> Multiple Choice</li>
                <li><strong>Total Mark:</strong> <?php echo $total_questions; ?></li>

            </ul>

            <a href="question.php?n=1" class="start">Start Quiz</a>
            <a href="welcome.php" class="start" style="margin-left: 244px;">Home</a>

        </div>
	</main>

    <footer class="footer" style="top: 310px;">
        <div class="copyright">
            <p>&copy; Copyright <span id="year"></span>. All rights reserved</p>
        </div>
    </footer>

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
    header("location:http://$host$uri/welcome.php");
    //header('location:welcome.php');
}
?>