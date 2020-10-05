<!DOCTYPE html>
<html>

<head>
    <!-- Site made with Mobirise Website Builder v4.9.1, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
    <meta name="description" content="Web Page Builder Description">
    <title>تعديل الملف الشخصي</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <!--style-->
    <link rel="stylesheet" type="text/css" href="manager_style.css">
</head>
<style>
#manger_edit_profile{
  width: 900px;
  padding-left: 100px;
  padding-right: 200px;

}
</style>
<body>
      <!--header-->
      <section class="menu cid-rhNDDxIGSq" id="menu1-4" >
        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top collapsed" >
          <div class="row" id="header">
            <div class="menu-logo" style="padding-right:940px;">
                <div class="navbar-brand">
                  <!-- AAL logo-->
                    <span class="navbar-logo">
                             <img src="assets/images/AAL logo.png" alt="شعار المحامي الذكي" style="height:7.5rem;">
                    </span>
                    <!-- system name-->
                    <p class="mbr-section mbr-bold display-2"> المحامي الذكي</p>
                </div>
           <!--home_page buttons-->
            </div>
               <div class="navbar-buttons mbr-section-btn" style="padding-top:40px;" >
                   <a name='home_page' class="btn btn-sm btn-primary display-4" href="home_page.php"> الصفحة الرئيسية</a>
               </div>
         </div>
       </nav>
     </section>


        <!-- main body-->
<div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
 <div class="container" id="list_main_body">

        <div class="container align-center">
            <div class="row">
                <div class="mbr-black col-lg-8 col-md-7 content-container">
                  <!--Titles-->
                  <div class="col-md-10 align-right" >
                      <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br>الملف الشخصي&nbsp;</h2>
                  </div>
                </div>

    <br><br><br><br>


    <?php
   session_start();
   $manager_email = $_SESSION['manger_email'];
   $manger_id = $_SESSION['manager_id'];
   $now = time();
   //check the sission time
   if ($now - $_SESSION['loggedin'] >3600) {
       unset ($_SESSION);
       session_destroy();
       echo '<script>alert("الرجاء تسجيل الدخول للموقع")</script>';
         echo '<script>window.location="sign_in.php"</script>';
       }

$connect = mysqli_connect("localhost", "root", "raghad123");
@mysqli_select_db ($connect,'smart_lawyer');

function test_input($data) {// Validate user's name & email
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$sql = "SELECT * FROM smart_lawyer.manager WHERE `manager_id`='$manger_id'";
$result = mysqli_query($connect,$sql);

$row = mysqli_fetch_assoc($result);

$managerID =  $row['manager_id'];
$managerFirstName =  $row['first_name'];
$managerLastName =  $row['last_name'];
$managerEmail =  $row['manager_email'];
$mangerPassword=$row['password'];
mysqli_free_result($result);

//update manger info
if(isset($_POST['submit'])){
    $profileFormfirstName = $_POST['first_name'];
    $profileFormLastName = $_POST['last_name'];
    $profileFormEmail = $_POST['email'];
    if(!empty($_POST['first_name']) and !empty($_POST['last_name']) and !empty($_POST['email'])){
    $profileFormfirstName = test_input($_POST['first_name']);
    if( !preg_match("/^[a-zA-Z ]*$/",$profileFormfirstName)){
      $fnameErr = "مسموح فقط بالأحرف والمسافات";
    }
    $managerLastName = test_input($_POST['last_name']);
    if( !preg_match("/^[a-zA-Z ]*$/",$managerLastName)){
      $lnameErr = "مسموح فقط بالأحرف والمسافات";
    }
    $profileFormEmail = test_input($_POST['email']);
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $emailErr = "صيغة البريد الإلكتروني غير صحيحة";
    }
    if($_POST['password']!=$_POST['password_repeat'] ){
      $passErr = "كلمة المرور غير متطابقة";
    }
  else{
    //encrypthion password using hash functhion and SHA-256 algorithm
    $hash = hash('sha256', $_POST['password']);
    //creating th salt using the revers statment
    $salt = strrev($_POST['password']);
   //creating the encrypted password
    $en_manager_password = hash('sha256', $salt . $hash);
    if(empty($_POST['password']) && empty($_POST['password_repeat'])){
    $sqlUpdate = "UPDATE `manager` SET `first_name` = '$profileFormfirstName', `last_name` = '$profileFormLastName', `manager_email` = '$profileFormEmail' WHERE `manager_id` = '$managerID'";
  }else{
    $sqlUpdate = "UPDATE `manager` SET `first_name` = '$profileFormfirstName', `last_name` = '$profileFormLastName', `manager_email` = '$profileFormEmail', `password` = '$en_manager_password' WHERE `manager_id` = '$managerID'";
    }
    if (mysqli_query($connect, $sqlUpdate)) {
        $_SESSION['manger_email']=$profileFormEmail;
        header("Refresh:0");
    }
}
}
}
?>


<form name="profileForm" class="mbr-form" action="" method="post" data-form-title="Mobirise Form" >

  <div data-for="name" id="manger_edit_profile" >
    <div class="form-group">
      <input type="text" class="form-control px-3" name="first_name" data-form-field="Name" value="<?php echo $managerFirstName;?>"  id="name-header15-j">
      <span class="remember" style="color:#ffffff"><?php echo $fnameErr;?></span></br>
    </div>
  </div>

  <div data-for="name" id="manger_edit_profile">
    <div class="form-group">
      <input type="text" class="form-control px-3" name="last_name" data-form-field="Name" value="<?php echo $managerLastName;?>"  id="name-header15-j">
      <span class="remember" style="color:#ffffff"><?php echo $lnameErr;?></span></br>
    </div>
  </div>

  <div data-for="email" id="manger_edit_profile">
    <div class="form-group">
       <input type="email" class="form-control px-3" name="email" data-form-field="Email" value="<?php echo $managerEmail;?>" id="email-header15-j">
       <span class="remember" style="color:#ffffff"><?php echo $emailErr;?></span></br>
    </div>
  </div>

  <div data-for="password" id="manger_edit_profile">
    <div class="form-group">
      <input type="password" class="form-control px-3" name="password" data-form-field="password" placeholder="ادخل كلمة السر" id="phone-header15-j">
      <span class="remember" style="color:#ffffff"><?php echo $passErr;?></span></br>
    </div>
  </div>

  <div data-for="password" id="manger_edit_profile">
    <div class="form-group">
      <input type="password" class="form-control px-3" name="password_repeat" data-form-field="password" placeholder="ادخل كلمة السر للتاكيد" id="phone-header15-j">
    </div>
  </div>


<!--buttons-->
  <span class="input-group-btn"id="manger_edit_profile"  >
    <!--cancel buttons-->
    <button  type="submit" name="submit1"  class="btn btn-form btn-info display-4" id="button" onclick="goBack()">إلغاء</button>
  </span>
  <!-- save buttons-->
  <span class="input-group-btn" id="manger_edit_profile">
    <button  type="submit" name="submit" class="btn btn-form btn-primary display-4">تعديل</button>
  </span>



<script>
function goBack() {
  window.history.back();
}
</script>







<?php
    mysqli_close($connect);


?>





    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/dropdown/js/script.min.js"></script>
    <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="assets/formoid/formoid.min.js"></script>


</body>

</html>
