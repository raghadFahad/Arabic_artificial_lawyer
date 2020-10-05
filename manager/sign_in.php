<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.9.1, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
  <meta name="description" content="Website Generator Description">
  <title>تسجيل الدخول&nbsp;</title>
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
#remember{
  float: right;
  padding-bottom: 50px;
  padding-right: 10px;
  color:#ffffff;
  font-size: 18px;
  height:20px;
  display:inline-block;
  line-height:20px;
  background-repeat:no-repeat;
  background-position: 0 0;
  vertical-align:middle;
  cursor:pointer;
}
</style>

<body>

      <?php

      // manger sign in information
      $mangerEmail=$_POST['email'];
      $mangerPassword=$_POST['password'];
      //encrypthion password using hash functhion and SHA-256 algorithm
      $hash = hash('sha256', $mangerPassword);
      //creating th salt using the revers statment
      $salt = strrev($mangerPassword);
     //creating the encrypted password
      $en_manager_password = hash('sha256', $salt . $hash);

      //if sign in button clicked
      if(isset($_POST['signin'])){
      // cheack manager's info not empty
      if(!empty($mangerEmail)&& !empty($en_manager_password)){
         //connect to database
      $connect = @mysqli_connect ("localhost", "root", "raghad123");
        @mysqli_select_db ($connect,'smart_lawyer');
            //cheack manager's info in the manger relation
            $select_manager_info= "select `manager_id`,`manager_email`,`password` from `manager` where `manager_email` = '$mangerEmail'
            AND `password`= '$en_manager_password' LIMIT 1";
            //retrave the result into rsult variable
            $result= @mysqli_query ($connect, $select_manager_info);
            $row=mysqli_fetch_array($result);
          //  if($row){
            //cheak if remember me checkbox is clicked
            if(!empty($_POST["remember"])) {//if it click
                   //set coockies name and time
                   setcookie ("member_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
                   setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                 } else {// if didn't click
                   if(isset($_COOKIE["member_login"])) {
                     setcookie ("member_login","");
                   }
                   //if it aleardy exist
                   if(isset($_COOKIE["member_password"])) {
                     setcookie ("member_password","");
                   }
                 }
                  //start manger's session
                  session_start();
                  //get manger sign-in info for the session
                  $sessionEmail= $row['manager_email'];
                  $sessionPass = $row['password'];
                  $sessionId = $row['manager_id'];
                  //check manger info to save session info
                if($sessionEmail == $mangerEmail && $sessionPass == $en_manager_password){
                     //set manger's email
                     $_SESSION['manger_email'] = $mangerEmail;
                     //set manger's password
                     $_SESSION['manager_password']= $en_manager_password;
                     //set manger's id session
                     $_SESSION['manager_id']= $row['manager_id'];
                     //set session time
                     $_SESSION['loggedin'] = time();
                     // redirct the manger to his/her home page
                     header('Location: home_page.php');
                } else{//if the manger's email or password doesn't match the manger's relation info
                 $infoErr = "الرجاء التأكد من صحة الأيميل وكلمة المرور" ;
                 }


      }

      // Close database connection
      mysqli_close($connect);

      }
       ?>
       <!--header-->
       <section class="menu cid-rhNDDxIGSq" once="menu" id="menu1-4">
         <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top collapsed">
           <div class="row" id="header">
             <div class="menu-logo" style="padding-right:940px;">
               <div class="navbar-brand">
               <!-- AAL logo-->
                 <span class="navbar-logo">
                      <img src="assets/images/AAL logo.png" alt="شعار المحامي الذكي" style="height:7.5rem;">
                 </span>
             <!-- system name-->
               <p class="mbr-section mbr-bold  mbr-fonts-style display-2">
                     المحامي الذكي</p>
              </div>
         </nav>
       </section>
<!-- Maiv bidy-->
     <section class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" id="header15-5">
         <div class="container align-right">
          <div class="row">
          <!--Title-->
           <div class="mbr-white col-lg-8 col-md-7 content-container">
             <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                 تسجيل الدخول&nbsp;</h1>
           </div>
         <!--sign in form-->
         <div class="col-lg-4 col-md-5">
         <div class="form-container">
             <div class="media-container-column" data-form-type="formoid">
                 <form class="mbr-form" action="" method="post" data-form-title="Mobirise Form">
                    <!-- email block-->
                     <div data-for="email">
                         <div class="form-group">
                           <input type="text" class="form-control px-3" name="email" placeholder="البريد الإلكتروني" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"required>
                         </div>
                     </div>
                     <!--password block-->
                     <div data-for="password">
                         <div class="form-group">
                           <input type="password" class="form-control px-3" name="password" placeholder="كلمة المرور" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required>
                         </div>
                     </div>
                     <!--remember me block-->
                     <div data-for="remwmber_me" >
                        <div class="form-group">
                        <input type="checkbox" name="remember" id="remember"  <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                            <label for="remember-me" id="remember">تذكرني؟</label>
                        </div>
                       <span class="error" id="remember"><?php echo $infoErr;?></span></br>
                      </div>
                     <!--sign in button-->
                     <span class="input-group-btn">
                       <button name="signin" type="submit" class="btn btn-form btn-info display-4">تسجيل الدخول&nbsp;</button></span>
                 </form>
             </div>
         </div>
         <a class="mbr-text pb-3 mbr-fonts-style display-5" href="help_me.php" style="color:#ffffff; float:left">من نحن؟</a>

       </div>
     </div>
  </section>



</body>
</html>
