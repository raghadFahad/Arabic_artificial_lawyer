<!DOCTYPE html>
<html >
<head>
  <!-- This page will used to make sure if the manger wanna delete this lawyer -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/AAL logo.png" type="image/x-icon">
  <meta name="description" content="Site Builder Description">
  <title> المحامي المطلوب حذفه&nbsp;</title>
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
  <form method="post" action="">
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

                     <p class="mbr-section mbr-bold display-2">المحامي الذكي</p>
               </div>
           </div>
           <!--home_page buttons-->
          <div class="navbar-buttons mbr-section-btn" style="padding-top:40px;" >
              <a name='home_page' class="btn btn-sm btn-primary display-4" href="home_page.php"> الصفحة الرئيسية</a>
          </div>
        </div>
      </nav>
    </section>
<!--Main body-->
   <div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
    <div class="container"  id="list_main_body">
    <!-- get manger id -->
    <?php
    $LawyerID = $_GET['LID'];
    $LawyerID = $_POST['LID'];
    $LawyerID = $_REQUEST['LID'];?>
    <!--Container-->
    <div class="container">
        <div class="row">
            <!--Titles-->
            <div class="col-md-10 align-center">
                <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br> حذف المحامي&nbsp;</h2>
                <hr>
            </div>
            <!--Retrive the data from the lawyer database-->
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
          <div div class="col-md-10 align-center" id="lawyer_form">
            <div class="card col-12 pb-5">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <!--lawyer image-->
                                <div class="image-cropper">
                                    <img src=<?php echo $photo?> alt="Mobirise" title="" height="200" width="200" align="middle">
                                </div>
                            </div>
                            <div class="col-12 col-md-10">
                                <!--lawyer's name-->
                                <div class="wrapper">
                                    <div class="top-line pb-3">
                                        <h4 class="card-title mbr-fonts-style display-5  align-center">المحامي /
                                          <?php echo $first_name;?>
                                            <?php echo $last_name;?>
                                        </h4>
                                    </div>
                                    <div class="bottom-line">
                                      <p class="mbr-text cost mbr-fonts-style m-0 display-5 align-center">هل أنت متأكد من حذف هذا المحامي؟</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!--buttons list-->
        <div class="container">
            <div class="media-container-row title">
                <div class="col-12 col-md-12" style="display: inline;">
                    <div class="mbr-section-btn align-center" style="margin-right:280px;">
                      <!--back button-->
                        <button class="btn btn-black display-4" name="back">رجوع</button>
                      <!--sure buutons-->
                        <button class="btn btn-danger display-4" name="delete"> نعم<br></button>


                      <?php
                      if(isset($_POST['delete'])){
                          print("delete<br>");

                      $change_State = "delete from `lawyer` where `lawyer_id`='$LawyerID'";
                      echo $LawyerID;
                      if (@mysqli_query ($connect, $change_State)) {
                      print '<p>update 1 is done.</p>';
                      }
                      else {
                      die ('<p>Could not update the database because: <b>' . mysqli_error($connect) . '</b></p>');
                    }
                        //confirm deleted masssge
                        echo '<script>alert("تم حذف المحامي")</script>';
                        //go back to accepted lawyer page
                        echo '<script>window.location="view_accepted_laywer.php"</script>';
                      }
                      //close the connection with SQLiteDatabase
                      mysqli_close($connect);

                      ?>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

</form>
</body>
</html>
