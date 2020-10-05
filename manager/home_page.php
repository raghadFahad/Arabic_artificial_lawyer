<!DOCTYPE html>
<html >
<head>
  <!-- This page will be the home page to manger when he/she can access to his/her services -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
  <meta name="description" content="Web Page Generator Description">
  <title>الصفحة الرئيسية&nbsp;</title>
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

<body>
  <?php
  session_start();
  $manager_email = $_SESSION['manger_email'];
  $now = time();
  //check the sission time
  if ($now - $_SESSION['loggedin'] >3600) {
      //if it finshed destroy the sesstion
      unset ($_SESSION);
      session_destroy();
      //view the masssge to manger
      echo '<script>alert("الرجاء تسجيل الدخول للموقع")</script>';
      //move the manger to sign in page
      echo '<script>window.location="sign_in.php"</script>';
      }
  if(isset($_POST["signout"])){
    if(!isset($_SESSION)){session_start();};
    unset($_SESSION['manger_email']);
    header('Location:sign_in.php');
    exit();
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
          <p class="mbr-section mbr-bold  mbr-fonts-style display-2">المحامي الذكي</p>
         </div>
        <!--sign out buttons-->
       </div>
       <div class="navbar-buttons mbr-section-btn" style="padding-top:40px;" >
         <form action="" method="post"  data-form-title="Mobirise Form">
          <button name='signout' type="submit" class="btn btn-sm btn-primary display-4">تسجيل الخروج</button>
         </form>
      </div>
     </div>
    </nav>
</section>

<!--main body-->
<div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
    <div  class="container" id="home_main_body">
        <div class="row justify-content-md-center">
          <!-- left sid of page-->
            <div class="col-md-10 align-center">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br><br>.... أهلاً</h1>
                <!--Manager's service-->
                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    يمكنك إستعراض ملفات المحامين المتقدمين للعمل في موقع المحامي الذكي&nbsp;<br>.كمحامين متطوعين للتواصل مع العملاء من خلال خدمه الدردشه المباشره<br><br><br></p>
                    <div class="mbr-section-btn"><a class="btn btn-md btn-black-outline display-4" href="view_accepted_laywer.php">إستعراض قائمة محامي الموقع</a>
                <a class="btn btn-md btn-black-outline display-4" href="view_waited_laywer.php">إستعراض قائمة المحامين المتقدمين للموقع</a>
            </div>
          </div>
      </div>
  </div>
<!-- Retrive manger's name to display in manger's home page-->
<?php
       //connect to database
      $connect = @mysqli_connect ('localhost', 'root', 'raghad123');
      @mysqli_select_db ($connect,'smart_lawyer');
      //cheack manager's info in the manger relation
      $select_manager_info= "select `manager_email`,`first_name`,`last_name`
                             from `manager`
                             where `manager_email` = '$manager_email' LIMIT 1";
     //retrave the result into rsult variable
     $result= @mysqli_query ($connect, $select_manager_info);
     $row=mysqli_fetch_array($result);
           ?>
<div id="m_profil">
    <!--Right sid of page : manger's profile-->
    <div style="width:270px;" class="form-container">
        <div class="media-container-column" data-form-type="formoid">
            <form class="mbr-form" action="" method="post" data-form-title="Mobirise Form">
               <!--Manager's name block-->
                <div data-for="name">
                    <div class="form-group">
                      <label class="form-control px-3" name="name" id="manger_info" ><?php echo $row['first_name'].' '.$row['last_name']; ?> </label>
                    </div>
                </div>
                <!--if edit profile service is clicked-->
                <span class="input-group-btn">
                  <a href="manager_edit_profile.php" class="btn btn-form btn-info display-4"> تعديل الملف الشخصي&nbsp;</a></span>
            </form>
        </div>
    </div>
</div>
<?php
//close the connection with SQLiteDatabase
mysqli_close($connect);
?>
</body>
</html>
