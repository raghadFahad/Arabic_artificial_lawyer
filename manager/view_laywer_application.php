<!DOCTYPE html>
<html >
<head>
  <!-- This page will used by thh manger to view a specific lawyer's CV-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
  <meta name="description" content="Site Builder Description">
  <title>السيرة الذاتية للمحامي&nbsp;</title>
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
  <!--cheack session time && connect to database-->
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
       //connect to database
       $connect = @mysqli_connect ('localhost', 'root', 'raghad123');
      @mysqli_select_db ($connect,'smart_lawyer');
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
                     <p class="mbr-section mbr-bold display-2">المحامي الذكي</p>
               </div>
           </div>
           <!--home_page buttons-->
          <div class="navbar-buttons mbr-section-btn" style="padding-top:40px;" >
            <a name='home_page' class="btn btn-sm btn-primary display-4" href="home_page.php">الصفحة لرئيسية</a>
          </div>
       </div>
    </nav>
  </section>

<!-- main body-->
<form method="post" action="">
<!--set the page background-->
<div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
 <div class="container" id="list_main_body">
   <!--get lawyer's id from URL-->
    <?php
    $LawyerID = $_GET['LID'];
    $LawyerID = $_POST['LID'];
    $LawyerID = $_REQUEST['LID'];?>
    <!--Container-->
        <div class="row">
            <!--Titles-->
            <div class="col-md-10 align-right" >
                <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br> عرض الطلب&nbsp;</h2>
                <hr>
            </div>
            <!--Card-1: load lawyer information-->
            <?php
            $loadLawyerinfo = "select `first_name`, `last_name`, `photo`, `cv` from `lawyer`
             where `lawyer_id`='$LawyerID' ";
            $result= @mysqli_query($connect , $loadLawyerinfo);
              while ($row = mysqli_fetch_array($result)){
                 $photo=$row['photo'];
                 $first_name=$row['first_name'];
                 $last_name=$row['last_name'];
                 $CV=$row['cv'];
               }
             ?>
            <!--display lawyer's info-->
            <div div class="col-md-10 align-center" id="lawyer_form">
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
                                        <!-- lawyer state-->
                                        <p class="mbr-text cost mbr-fonts-style m-0 display-5">حالة الطلب: معلق</p><br>
                                  </div>
                             </div>
                        </div>
                   </div>
                </div>
             </div>
        <!--buttons list-->
        <div class="container">
          <div class="bottom-line">
                <div class="col-12 col-md-10">
                    <div class="mbr-section-btn align-right">
                       <!-- download lawyer's cv buttons-->
                       <a class="align-right btn btn-primary display-4" href=<?php echo $CV ?>>عرض السيره الذاتيه</a>
                        <!-- diclent lawyer's cv buttons-->
                        <button class="btn btn-secondary display-4" name="decline">رفض</button>
                        <!-- accept lawyer's cv buttons-->
                        <button class="btn btn-danger display-4" name="accept">قبول<br></button>
                    </div>
                </div>
            </div>
                      <!-- buttons PHP-->
                      <?php
                      //if manger click accept buttons
                      if(isset($_POST['accept'])){
                      //update lawyer's state
                      $change_State = "update `lawyer` set `state`='accept'
                      where `lawyer_id`='$LawyerID' LIMIT 1";
                      //apply the query
                      @mysqli_query ($connect, $change_State);
                      }
                      //if manger click declint buttons
                      if(isset($_POST['decline'])){
                      //update lawyer's state query
                      $change_State = "update `lawyer` set `state`='decline'
                      where `lawyer_id`='$LawyerID' LIMIT 1";
                      //apply the query
                      @mysqli_query ($connect, $change_State);
                      }
                      //close the connection with SQLiteDatabase
                      mysqli_close($connect);
                      ?>
            </div>
        </div>
        <!-- go back to view_waited_laywer buttons-->
        <div class="title col-12" >
            <h2 class="align-left mbr-fonts-style m-0 display-1">
            <a class="btn btn-black display-4" href="view_waited_laywer.php" style="margin-right:100px;">رجوع</a>
             </h2>
        </div>
</div>
</div>
</div>
</form>
</body>
</html>
