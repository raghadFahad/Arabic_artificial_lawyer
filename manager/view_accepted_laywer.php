<!DOCTYPE html>
<html >
<head>
  <!-- This page is used by mager to view the accepted lawyer and in this page manger
  can delete lawyer using search bar or the viewed lawyer's list -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo2-122x61.png" type="image/x-icon">
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
     <!-- header-->
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
            <a name='home_page' class="btn btn-sm btn-primary display-4" href="home_page.php">الصفحة الرئيسية</a>
          </div>
        </div>
      </nav>
    </section>

<!-- Main page-->
  <div class="cid-rhPDJhyDU2 mbr-fullscreen mbr-parallax-background" >
    <div class="container"  id="list_main_body">
        <div class="row">
            <!--Titles-->
            <div class="col-md-10 align-center" >
                <h2 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><br>قائمة المحامين المقبولين&nbsp;</h2>
                <hr><br>
            </div>
            <!--form for lawyer's id search-->
            <form method="post" action="">
              <div class="title col-12" id="searchbar">
                <input type="text" name="lawyer_id"  id="search" placeholder="...أكتب رقم المحامي" style="margin-right:100px;"/>
                <input style="margin-top:0px;" class="align-left btn btn-primary display-4" type="submit" value="بحث" name="search"/>
                <br><br><hr><br><br>
              </div>
            </form>
            <!--search buttons php-->
            <?php
            //lawyer's id
            $LawyerID=$_POST['lawyer_id'];
            //if manger click the search's buttons
     				if ( isset ($_POST['search'])) {
     				$query ="SELECT * FROM `lawyer` where `lawyer_id`='$LawyerID'";
     	      $result = mysqli_query($connect, $query);
            ?>
        <!-- Retrive all accepted lawyers' data from database-->
        <?php
     		while($row=mysqli_fetch_array($result))
     		{
          //lawyer's info
          $photo=$row['photo'];
          $first_name=$row['first_name'];
          $last_name=$row['last_name'];
          $LawyerID=$row['lawyer_id'];
          $CV=$row['cv'];
        ?>
     <!--lawyers' list-->
     <div class="col-md-10 align-center" id="lawyer_form">
      <div class="card col-12 pb-5">
          <div class="card-wrapper media-container-row media-container-row">
              <div class="card-box align-center">
                  <div class="row">
                      <!--lawyer's image-->
                      <div class="col-12 col-md-2">
                          <div class="image-cropper">
                            <img src=<?php echo $photo?> alt="Mobirise" title="" height="200" width="250" align="middle">
                          </div>
                      </div>
                      <div class="col-12 col-md-10">
                          <div class="wrapper">
                            <!-- lawyer' name-->
                              <div class="top-line pb-3">
                                  <h4 class="card-title mbr-fonts-style display-3">المحامي /
                                    <?php echo $first_name;?>
                                      <?php echo $last_name;?>
                                  </h4>
                              </div>
                              <!-- lawyer id-->
                              <div class="bottom-line">
                                <p class="mbr-text cost mbr-fonts-style m-0 display-5">ID: <?php echo $LawyerID;?></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  <!-- list of buttons-->
  <div class="container">
      <div class="media-container-row title">
          <div class="col-12 col-md-8">
              <div class="mbr-section-btn align-center">
                <!--view the lawyer's CV-->
                 <a class=" btn btn-secondary display-4" href=<?php echo $CV ?>>عرض السيره الذاتيه</a>
                <!-- delete buttons-->
                 <a class="btn btn-danger display-4" href="delete_notify_laywer.php?LID=<?php echo $LawyerID ?>">حذف المحامي</a>
                  <hr>
               </div>
          </div>
      </div>
  </div>
</div>
      <?php
     		}
     				   }
               else{
     				   ?>

  </div>
            <!--Card-1-->
            <?php
            $loadLawyerinfo = "select `cv`, `lawyer_id`, `first_name`, `last_name`, `lawyer_email`, `photo` from `lawyer`
             where `state`='accept' ";
            $result= @mysqli_query($connect , $loadLawyerinfo);
              //lretrive the lawyer's info from database
              while ($row = mysqli_fetch_array($result)){
                 $photo=$row['photo'];
                 $first_name=$row['first_name'];
                 $last_name=$row['last_name'];
                 $LawyerID=$row['lawyer_id'];
                 $CV=$row['cv'];
             ?>
            <div class="card col-12 pb-5" style="color:rgba(240,248,255);" >
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box align-center">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <!--lawyer's image-->
                                <div class="image-cropper">
                                    <img src=<?php echo $photo?> alt="Mobirise" title="" height="200" width="250" align="middle">
                                </div>
                            </div>
                            <div class="col-12 col-md-10">
                                <!-- lawyer's name-->
                                <div class="wrapper">
                                    <div class="top-line pb-3">
                                        <h4 class="card-title mbr-fonts-style display-2">المحامي /
                                          <?php echo $first_name;?>
                                            <?php echo $last_name;?>
                                        </h4>
                                    </div>
                                    <!--lawyer's id-->
                                    <div class="bottom-line">
                                      <p class="mbr-text cost mbr-fonts-style m-0 display-5">ID: <?php echo $LawyerID;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="container">
            <div class="media-container-row title">
                <div class="col-12 col-md-8">
                    <div class="mbr-section-btn align-center">
                      <!-- view lawyer's info buttons-->
                       <a class=" btn btn-secondary display-4" href=<?php echo $CV ?>>عرض السيره الذاتيه</a>
                       <!-- delete buttons-->
                       <a class="btn btn-danger display-4" href="delete_notify_laywer.php?LID=<?php echo $LawyerID ?>">حذف المحامي</a>
                        <hr>
                     </div>
                </div>
            </div>
        </div>
    </div>
  <?php }}
  //close the connection with SQLiteDatabase
  mysqli_close($connect);?>

    <hr>
</div>
</div>
</div>
</form>
</body>
</html>
