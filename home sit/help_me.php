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
  <title>مساعدة&nbsp;</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <!--style-->
  <link rel="stylesheet" type="text/css" href="manger_style.css">
</head>
<style>
#help_me{
 height: 700px;
 width: 350px;
 background-color: rgba(25,25,112,0.6);
 border-radius: 8px;
 margin-top: 110px;
 margin: 40px;
 padding-top: 100px;
 padding-left: 40px;
 padding-right: 30px;
 font-size: 20px;
}
</style>
<body>
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
</body>
<?php
session_start();
//get certin time
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
 ?>

 <!--main body-->
 <div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
     <div  class="container" id="home_main_body">
         <div class="row justify-content-md-center">
           <!-- left sid of page-->
             <div class="col-md-10 align-center">
                 <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br><br>من نحنُ؟</h1>
                 <!--Manager's service-->
                 <p class="mbr-text pb-3 mbr-fonts-style display-5">
                 كثير من الناس يعاني من بعض المشاكل القانونية المختصة بقانون العمل والكثير منهم يرغب في الحصول على استشارة قانونية ولكن هذه الاستشارة تكون باهضه الثمن   &nbsp;<br>. لذا أنشأنا هذا الموقع الذي يوفر الاستشارة المجانية للعملاء باستخدام المحامي الذكي (الرد الآلي)، كما يوفر التواصل بشكل مباشر بين عملاء الموقع وللمحامين المتطوعين له، وأيضاً الاطلاع على قوانين العمل. وأيضاً يوفر فرصة للمحامين الراغبين بالتطوع.  <br><br><br></p>

           </div>
       </div>
   </div>

 <div id="help_me">
     <!--Right sid of page : manger's profile-->

     <div style="width:270px;" class="form-container">
         <div class="media-container-column" data-form-type="formoid">
           <p class="mbr-bold pb-1 mbr-fonts-style display-5" style="color: #ffffff;text-align:right;">القائمون على الموقع</p>
           <p class="mbr-text pb-3 mbr-fonts-style display-5"  style="color: #ffffff; text-align:right;">
             رغد فهد باجحلان<br> الشيماء يحيى <br> رهف خالد الغامدي <br> سلوى عمير الحجاجي <br> شوق طلال العتيبي
           </p><br>
           <p class="mbr-bold pb-1 mbr-fonts-style display-5" style="color: #ffffff;text-align:right;">بإشراف</p>
           <p class="mbr-text pb-3 mbr-fonts-style display-5"  style="color: #ffffff; text-align:right;">
             د.باسم الكاظمي
           </p><br>


         </div>
     </div>
 </div>
