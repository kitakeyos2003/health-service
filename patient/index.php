<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/animations.css">  
    <link rel="stylesheet" href="../public/css/main.css">  
    <link rel="stylesheet" href="../public/css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");

    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();

    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    //echo $userid;
    //echo $username;
    
    ?>
        <script type="text/javascript" language="javascript">
             $(document).ready(function() {
                let active = null;
                nextPage("#home", './home.php')
                $("#home").click(function(event) {
                    nextPage("#home", './home.php')
                });
                $("#doctor").click(function(event){
                    nextPage("#doctor", './doctors.php')
                });
                $("#schedule").click(function(event){
                    nextPage("#schedule", './schedule.php')
                });
                $("#appointment").click(function(event){
                    nextPage("#appointment", './appointment.php')
                });
                $("#settings").click(function(event){
                    nextPage("#settings", './settings.php')
                });
                function nextPage(pageId, pageUrl) {
                    if (active != null) {
                        active.removeClass('menu-active menu-icon-home-active');
                    }
                    if (pageId != null) {
                        active = $(pageId);
                        active.addClass('menu-active menu-icon-home-active');
                    }
                    $('#dash-body').load(pageUrl);
                }
             });
          </script>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../public/img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Đăng xuất" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home" id="home">
                        <a class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Trang chủ</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor" id="doctor">
                        <a class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Bác sĩ</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session" id="schedule">
                        <a class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Đặt lịch</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment" id="appointment">
                        <a class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Lịch hẹn</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings" id="settings">
                        <a class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Cài đặt</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px" id="dash-body">
            
        </div>
    </div>
</body>
</html>