<?php
include"include/connection.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin.css">

</head>
<body>

<h2>ADMIN LOGIN</h2><br>    
    <div class="login"> 
  
    <form id="login" method="post" action="">    
        <label><b>Admin Name     
        </b>    
        </label>    
        <input type="text" name="AdName" id="Aname" placeholder="Name" required>    
        <br><br>    
        <label><b>Password     
        </b>    
        </label>    
        <input type="Password" name="AdPass" id="Pass" placeholder="Password" required>    
        <br><br>    
        <input type="submit" name="log" class="btn"  value="Log In">         
    </form>     
</div>
<?php
 
function input_filter($data){
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data; 
}
if(isset($_POST['log']))
{
$AdminName=input_filter($_POST['AdName']);
$AdminPass=input_filter($_POST['AdPass']);

$AdminName=mysqli_real_escape_string($con,$AdminName);
$AdminPass=mysqli_real_escape_string($con,$AdminPass);

$query="SELECT * FROM `admin_login` WHERE Admin_name=? AND Admin_password=?";
if($stmt=mysqli_prepare($con,$query))
{
mysqli_stmt_bind_param($stmt,"ss",$AdminName,$AdminPass);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if(mysqli_stmt_num_rows($stmt)==1) 
{
session_start();
$_SESSION['AdminLoginId']=$AdminName;
header("location:admin_panel.php");

}
else
{
echo"<script>alert('Incorrect Admin Name or Password');</script>";
}
mysqli_stmt_close($stmt);
}
else
{
echo"<script>alert('Login Failed');</script>";
}
}
?>



<script src="js/script.js"></script>
</body>
</html