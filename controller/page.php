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
                                "schoolabout",
                                "forums",
                                "schoolforum",
                                "publicforum",
                                
                                "modal-recheck_staff",
                                "modal-recheckstudentlist",
                                "modal-recheckparentlist",
                                "modal-rechecktimetablelist",
                                "modal-recheck_class",
                             
                                "staffdetail",
                                "studentdetail",
                                "eventdetail",
                                "newsdetail",
                                "departmentdetail",
                                "subjectdetail",
                                "classdetail",
                                "forumdetail",

                                "add_news",
                                "add_event",
                                "add_forums",
                                "add_department",
                                "add_subject",
                                "add_class",
                                "add_staff",
                                "add_student",
                                "add_parent",
                                
                                "departmentattendance",
                                "classattendance",
                                "exportstaffattendance",
                                "exportstudentattendance",
                                "exportclassattendance",
                                "mail",

                                "addrelationstudentforstudent",
                                "addrelationforstudent",
                                "addrelationstudentforparent",
                                "addrelationforparent",
                                "duplicateforparentlist",
                                "duplicateforstudentlist",
                                "test",
                               );

    $teacherallowedaccess = array("dashboard",
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
                                "schoolabout",
                                "forums",
                                "schoolforum",
                                "publicforum",
                                
                                //"modal-recheck_staff",
                                //"modal-recheckstudentlist",
                                //"modal-recheckparentlist",
                                "modal-rechecktimetablelist",
                                //"modal-recheck_class",

                                "staffdetail",
                                "studentdetail",
                                "eventdetail",
                                "newsdetail",
                                "departmentdetail",
                                "subjectdetail",
                                "classdetail",
                                "forumdetail",

                                "add_news",
                                "add_event",
                                "add_forums",
                                //"add_department",
                                //"add_subject",
                                //"add_class",
                                //"add_staff",
                                //"add_student",
                                //"add_parent",
                                
                                
                                //"departmentattendance",
                                "classattendance",
                                //"exportstaffattendance",
                                //"exportstudentattendance",
                                //"exportclassattendance",
                                "mail",

                                //online learning//
                                "ol_dashboard",
                                "ol_calendar",
                                "ol_modal-recheckquiz",
                                "ol_addannouncement",
                                "ol_addglossary",
                                "ol_addquiz",
                                "ol_addassignment",
                                "ol_addurl",
                                "ol_addsurvey",
                                "ol_survey",
                                "ol_subject",
                                "ol_notes",
                                "ol_submit_assignment",
                                "ol_submit_quiz",
                                "ol_submit_survey",
                                "ol_quiz",
                                "ol_announcement",
                                "ol_assignment",

                                //rujukan mira
                                "suggestions",
                                "mira",
                                "simplecalendar",
                                "save",
                                "send",
                                "fetch",
                                );


    $studentallowedaccess = array("dashboard",
                                "news",
                                "event",
                                //"stafflist",
                                //"parentlist",
                                //"studentlist",
                                //"timetablelist",
                                //"classroomlist",
                                //"subjectlist",
                                //"departmentlist",
                                "profile",
                                "personal-information",
                                "change-password",
                                "schoolabout",
                                "forums",
                                "schoolforum",
                                "publicforum",
                                
                                //"modal-recheck_staff",
                                //"modal-recheckstudentlist",
                                //"modal-recheckparentlist",
                                //"modal-rechecktimetablelist",
                                //"modal-recheck_class",

                                //"staffdetail",
                                //"studentdetail",
                                "eventdetail",
                                "newsdetail",
                                //"departmentdetail",
                                "subjectdetail",
                                "classdetail",
                                "forumdetail",

                                //"add_news",
                                //"add_event",
                                //"add_forums",
                                //"add_department",
                                //"add_subject",
                                //"add_class",
                                //"add_staff",
                                //"add_student",
                                //"add_parent",
                                
                                
                                //"departmentattendance",
                                //"classattendance",
                                //"exportstaffattendance",
                                //"exportstudentattendance",
                                //"exportclassattendance",
                                //"mail",

                                //online learning//
                                "ol_dashboard",
                                "ol_calendar",
                                "ol_modal-recheckquiz",
                                "ol_addannouncement",
                                "ol_addglossary",
                                "ol_addquiz",
                                "ol_addassignment",
                                "ol_addurl",
                                "ol_addsurvey",
                                "ol_survey",
                                "ol_subject",
                                "ol_notes",
                                "ol_submit_assignment",
                                "ol_submit_quiz",
                                "ol_submit_survey",
                                "ol_quiz",
                                "ol_announcement",
                                "ol_assignment",
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
                elseif ($_SESSION["loggeduser_ACCESS"]=="STUDENT")
                {
                    if (in_array($_GET['page'], $studentallowedaccess)){
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