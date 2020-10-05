<!DOCTYPE html>
<html >
<head>
  <!-- This page is used by manger to view a list of volunteer lawyers' appliction -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
  <meta name="description" content="Site Builder Description">
  <title>قائمة المحامين&nbsp;</title>
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
  <!-- check session time && connecte to Mysql database -->
  <?php
  session_start();
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
     //connect to database
     $connect = @mysqli_connect ('localhost', 'root', 'raghad123');
    @mysqli_select_db ($connect,'smart_lawyer');
    //back to privos page
    if(isset($_POST["back"])){
      header('Location: view_accepted_laywer.php');
    }

   ?>

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

<!--Main body of page-->
  <!-- set background style-->
  <div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
    <div class="container" id="list_main_body">
        <div class="row">
            <!--Titles-->
            <div class="col-md-10 align-center">
                <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br>قائمة المحامين في قيد الانتظار&nbsp;</h2>
                <hr><br>
              </div>
            <!--Lawyer list-->
          <div class="col-md-10 align-center" id="lawyer_form">
            <form method="post" action="">
            <!-- Retrive the lawyer data fro lawyer relation-->
            <?php
            $loadinfo = "select `cv`, `lawyer_id`, `first_name`, `last_name`, `lawyer_email`, `photo` from `lawyer`
             where `state`='wait' ";
            $result= @mysqli_query($connect , $loadinfo);
              while ($row = mysqli_fetch_array($result)){
                 $photo=$row['photo'];
                 $first_name=$row['first_name'];
                 $last_name=$row['last_name'];
                 $LawyerID=$row['lawyer_id'];
             ?>
            <div class="card col-12 pb-5">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box align-center">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <!--lawyer's image-->
                                <div class="image-cropper">
                                    <img src=<?php echo $photo?> alt="صورة الملف الشخصي"  align="middle">
                                </div>
                            </div>
                            <!--lawyer's name-->
                            <div class="col-12 col-md-10">
                                <div class="wrapper">
                                    <div class="top-line pb-3">
                                        <h4 class="card-title mbr-fonts-style display-2">المحامي /
                                          <?php echo $first_name;?>
                                            <?php echo $last_name;?>
                                        </h4>
                                    </div>
                                    <!--lawyer's state-->
                                    <div class="bottom-line">
                                      <p class="mbr-text cost mbr-fonts-style m-0 display-5">حالة الطلب: معلق</p><br>
                                    </div>
                                </div>
                                <!--buttons that moves to view a specific lawyer's application-->
                                <div class="mbr-section-btn align-center" style="float:left;">
                                  <a class="btn btn-primary display-4" href="view_laywer_application.php?LID=<?php echo $LawyerID ?>">عرض الطلب</a>
                                  <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
    <?php }

                          //close the connection with SQLiteDatabase
                          mysqli_close($connect);
                          ?>
    <hr>
</div>
</div>
</div>


</form>
</body>
</html>
