<?php
    $staffallowedaccess = array("dashboard",
                                "news",
                                "event",
                                "stafflist",
                                "parentlist",
                                "studentlist",
                                "timetablelist",
                                "classroomlist",
                                "subjectlist",
                                "departmentlist",
                                "profile",
                                "personal-information",
                                "change-password",
                                "departmentinfo",
                                "schoolabout",
                                "forums",
                                "schoolforum",
                                "publicforum",
                                
                                "modal-news",
                                "modal-event",
                                "modal-forums",
                                "modal-recheckstafflist",
                                "modal-recheckstudentlist",
                                "modal-recheckparentlist",
                                "modal-rechecktimetablelist",
                                "modal-recheckclassroomlist",
                             
                                "staffdetail",
                                "studentdetail",
                                "eventdetail",
                                "newsdetail",
                                "departmentdetail",
                                "classdetail",
                                "schoolforumdetail",
                                "publicforumdetail",

                                "addstaff",
                                "addstudent",
                                "addparent",
                                "adddepartment",
                                "addsubject",
                                "addclass",

                                "departmentattendance",
                                "classattendance",
                                "exportstaffattendance",
                                "exportstudentattendance",
                                "exportclassattendance",
                                "mail",
                                "login",
                                "addrelationstudentforstudent",
                                "addrelationforstudent",
                                "addrelationstudentforparent",
                                "addrelationforparent",
                                "mira",
                                "kid",
                                //"testing",
                               );

    $teacherallowedaccess = array("dashboard",
                                "news",
                                "event",
                                "stafflist",
                                "parentlist",
                                "studentlist",
                                "timetablelist",
                                //"classroomlist",
                                //"subjectlist",
                                //"departmentlist",
                                "profile",
                                "personal-information",
                                "change-password",
                                "departmentinfo",
                                "classroominfo",
                                "schoolabout",
                                "forums",
                                "schoolforum",
                                "publicforum",
                                
                                //"modal-news",
                                //"modal-event",
                                "modal-forums",
                                //"modal-recheckstafflist",
                                //"modal-recheckstudentlist",
                                //"modal-recheckparentlist",
                                "modal-rechecktimetablelist",
                                //"modal-recheckclassroomlist",

                                "staffdetail",
                                "studentdetail",
                                "eventdetail",
                                "newsdetail",
                                //"departmentdetail",
                                "classdetail",
                                "schoolforumdetail",
                                "publicforumdetail",

                                //"addstaff",
                                //"addstudent",
                                //"addparent",
                                //"adddepartment",
                                //"addsubject",
                                //"addclass",

                                //"departmentattendance",
                                //"classattendance",
                                //"exportstaffattendance",
                                //"exportstudentattendance",
                                //"exportclassattendance",
                                //"testing",
                                );

    if(!isset($_SESSION['loggeduser_id']) && empty($_SESSION['loggeduser_id'])) 
    {
        ?>
        <div class="row" style="height:100vh;">
            <div class="col-sm-12 col-lg-6" style="background-image:url(images/loginpagebg.jpg); background-repeat:no-repeat; background-size:cover;">
            </div>
                <?php include 'view/pages/login.php'; ?>
        </div>
        <?php
    } 
    else
    {
        if (!isset($_GET['page']) || empty($_GET['page']))
        {
            include 'view/pages/dashboard.php';
        } 
        else 
        {
            if (file_exists('view/pages/'. $_GET['page'] . ".php")) 
            {
                if($_SESSION["loggeduser_ConsumerGroupName"] == "GONGETZ")
                {
                    include 'view/pages/'. $_GET['page'] . ".php";
                }
                elseif ($_SESSION["loggeduser_ACCESS"]== "TEACHER")
                {
                    if (in_array($_GET['page'], $teacherallowedaccess)){
                        include 'view/pages/'. $_GET['page'] . ".php";
                    } else {
                        include 'view/pages/unauthorized.php';
                    }
                }
                elseif ($_SESSION["loggeduser_ACCESS"]=="STAFF")
                {
                    if (in_array($_GET['page'], $staffallowedaccess)){
                        include 'view/pages/'. $_GET['page'] . ".php";
                    } else {
                        include 'view/pages/unauthorized.php';
                    }
                }
            }
            else 
            {
                include 'view/partials/error.html';
            }
        }   
    }
?>