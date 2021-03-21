<?php
session_start(); 

include('../control/updatecheck.php');


if(empty($_SESSION["username"])) // Destroying All Sessions
{
header("Location: ../control/login.php"); // Redirecting To Home Page
}

?>

<!DOCTYPE html>
<html>
<body>
<h2>Profile Page</h2>

Hii, <h3><?php echo $_SESSION["username"];?></h3>
<br>Your Profile Page.
<br><br>
<?php

$radio1=$radio2=$radio3="";
$checkbox1=$checkbox2=$checkbox3="";
$firstname=$email=$password=$profession=$dob=$address="";
$connection = new db();
$conobj=$connection->OpenCon();

$userQuery=$connection->CheckUser($conobj,"student",$_SESSION["username"],$_SESSION["password"]);

if ($userQuery->num_rows > 0) {

    // output data of each row
    while($row = $userQuery->fetch_assoc()) {
      $firstname=$row["firstname"];
      $email=$row["email"];
      $password=$row["password"];
      $profession=$row["profession"];
      $dob=$row["dob"];
      $address=$row["address"];
      
     
      if(  $row["interests"]=="music" )
      { $checkbox1="checked"; }
      else if(  $row["interests"]=="sports")
      { $checkbox2="checked"; }
      else{$checkbox3="checked";}

      if(  $row["gender"]=="female" )
      { $radio1="checked"; }
      else if($row["gender"]=="male")
      { $radio2="checked"; }
      else{$radio3="checked";}


   
 

  } 
}
  else {
    echo "0 results";
  }



?>
<form action='' method='post'>

Firstname : <input type='text' name='firstname' value="<?php echo $firstname; ?>" >
Email : <input type='text' name='email' value="<?php echo $email; ?>" >
Profession : <input type='text' name='profession' value="<?php echo $profession; ?>" >
Date of Birth : <input type='date' name='dob' value="<?php echo $dob; ?>" >
Password : <input type='password' name='password' value="<?php echo $password; ?>" >
Address : <input type='text' name='address' value="<?php echo $address; ?>" >
<br>
<br>
 Gender:
     <input type='radio' name='gender' value='female'<?php echo $radio1; ?> >Female
     <input type='radio' name='gender' value='male' <?php echo $radio2; ?> >Male
     <input type='radio' name='gender' value='other'<?php echo $radio3; ?> > Other
<br>
<br>
     Choose your Interest :
     <input type='checkbox' id='interests' name='interests' value='music'<?php echo $checkbox1; ?> >music
     <input type='checkbox' id='interests' name='interests' value='sports'<?php echo $checkbox2; ?> >sports
     <input type='checkbox' id='interests' name='interests' value='games'<?php echo $checkbox3; ?> >games
  
  <br>
  <br>
  Choose a Profession :
  <select name="profession" id="profession"><option value="student">student</option> 
   <option value="teacher">teacher</option>
   <option value="academician">Academician</option> </select>

  <br>
  <br>
     <input name='update' type='submit' value='Update'>  

     <?php echo $error; ?>
<br>
<br>
<a href="../view/pageone.php">Back </a>

<a href="../control/logout.php"> logout</a>

</body>
</html>