<!DOCTYPE HTML>
<html>

<head>
    <title>Registration Page </title>
</head>

<body>
<?php
include('db.php');
session_start(); 

$validatename=$validateemail=$name=$email=$validatepassword=$password=$validateusername=$username="";
$validatecpassword=$cpassword=$v1=$v2=$v3="";

if($_SERVER["REQUEST_METHOD"]= "POST"){
    $connection = new db();
    $conobj=$connection->OpenCon();
    $name = $_POST["firstName"];
    $email = $_POST["email"];
    $username = $_POST["userName"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $dob = $_POST["birthday"];
    $gender = $_POST["gender"];


    $userQuery=$connection->InsertUser($conobj,"registrationformdata",$firstname,$email,$username,$password,$gender,$dob);

    if(empty($_POST["firstName"])||!preg_match("/^[a-zA-Z-' ]*$/",$name))
    {
        $validatename="Valid Name is required.";
    }else{
            $validatename="Your name is ".$name;
        }
    if (empty($_POST["email"]) || !preg_match("@.",$email)) {
        $validateemail = "Valid Email is required";
    } 
    else{
        $email = "Your email is".$email;
    }
    if(empty($password) || (strlen($password))<6 || !preg_match("@#$%",$password))
    {
        $validatepassword = "Invalid password.";
    }
    if(empty($username)|| (strlen($username))<5){
        $validateusername = "Invalid user name";
    }
    else{
        $validateusername = "Your username is ".$username;
    }
    if($password!=$cpassword){
        $validatecpassword = "Password doesn't match.";
    }
if(!isset($_REQUEST["gender1"]) && !isset($_REQUEST["gender1"]) && !isset($_REQUEST["gender1"]))
{
    echo "Please select one gender.";
    
}else{

    if(isset($_POST["gender1"])){
        echo $v1=$_POST["gender1"];
    }
    elseif(isset($_POST["gender2"])){
        echo $v2=$_POST["gender2"];
    }elseif(isset($_POST["gender3"])){
        echo $v3=$_POST["gender3"];
    }

}
$connection->CloseCon($conobj);
}

?>
    <h1>My Registration Page</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="firstName"> <?php echo $validatename;?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email"><?php echo $validateemail;?></td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td><input type="text" name="userName"><?php echo $validateusername;?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="passsword"><?php echo $validatepassword;?></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="cpassword"><?php echo $validatecpassword;?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                    <?php echo $v1;?>
                    <?php echo $v2;?>
                    <?php echo $v3;?>

                </td>
            </tr>
            <tr>
                <td>Date of Birth <br></td>
                <td><input type="date" name="birthday"></td>
            </tr>
            <tr>

                <td><input type="submit" value="submit">
                    <input type="reset">
                </td>


            </tr>

        </table>

    </form>
</body>

</html>