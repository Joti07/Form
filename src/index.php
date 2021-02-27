<?php
//index.php

$error = '';
$name = '';
$email = '';
$mobile = '';
$message = '';
$date='';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }


if(empty($_POST["mobile"]))
 {
  $error .= '<p><label class="text-danger">Mobile is required</label></p>';
 }
 else
 {
  $mobile = clean_text($_POST["mobile"]);
 }
 
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
  
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }
if ($error == '') {
    $file_open = fopen("contact_data.csv", "a");
    $no_rows = count(file("contact_data.csv"));
    if ($no_rows > 1) {
        $no_rows = ($no_rows -1) +1;
    }
    $form_data = array(
            'sr_no' => $no_rows+1,
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'mobile' => $mobile,
            'date'=> date("d-m-Y"),
        );
        fputcsv($file_open,$form_data);
        $error = '<label class="text-success">Data Stored</label>';
       
        $name = '';
        $email = '';
        $mobile = '';
        $message = '';
        $date='';
    }

}

?>
<!DOCTYPE html>
<html>
 <head>
 	
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
 <body style="background:url(brick.jpg); position:center; background-size:cover;">
  <br />
  <?php if(!empty($error)) {
         echo '<div class="alert alert-success alert-dismissable fade show" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         '.$error.'</div>';
        // echo'<button type="button"><span aria-hidden="ture">&times</button>';
     }
     ?>
 
  <div class="container" style="background:rgba(0,0,0,0.6); color:#ffff box-sizing:border-box;transform:translate(-50%,-50%);top:50%;left:50%;position:absolute;">
   <div class="col-md-6" style="margin:0 auto; float:none; ">
     
    <form method="post" >
     <br />
     
     <div class="form-group" >
      <label style="color:white">Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" style="background=transparent; width:100%;"value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label style="color:white">Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     
     <div class="form-group">
      <label style="color:white">Enter Mobile</label>
      <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile" value="<?php echo $mobile; ?>" />
     </div>
     <div class="form-group">
      <label style="color:white">Enter Message</label>
      <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
     </div>
     <div class="form-group" align="center" >
      <input type="submit" name="submit" class="btn btn-danger btn-block" role="button" value="Submit" />
     </div>
     <div class="form-group" align="center" >
     <a href="home.php">View all</a>
     </div>
     
    </form>
   </div>
  </div>
 </body>
</html>