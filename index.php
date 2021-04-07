<!doctype html>
<?php
// Start the session
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php include 'connections/db.php';?>
<?php require 'vendor/autoload.php'; ?>
<!-- live chat start-->
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="688d97be-cab6-4cc7-9458-e78b5df8cba4";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<!-- live chat end-->
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- LOCAL -->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="resources/default.css">
   
    <!-- HOSTED ONLINE -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/v4-shims.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Bootstrap jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <!-- TinyMCE js -->
    <script src="https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Smart School</title>
  </head>

  <body>
    <!--#include file="components/sha256.asp" -->
    <?php
    /*** check if the users is already logged in ***/
    if(isset($_SESSION["loggeduser_schoolID"]) && !empty($_SESSION["loggeduser_schoolID"]))
    {
      include 'view/navbar.php';
    }
    ?>
    <div class="maincontainer">
      <div class="container-fluid">
        <?php include 'view/modal-changepassword.php'; ?>
        <?php include 'view/alert.php'; ?>
          <?php
          if(!isset($_SESSION["loggeduser_schoolID"]) && empty($_SESSION["loggeduser_schoolID"]))
          {
          ?>
                <?php include 'view/login.php'; ?>
          <?php
          }
          else
          {
          ?>
            <?php
            if (!isset($_GET['page']) || empty($_GET['page'])){
              include 'view/home.php';
            }

            //view random
            elseif ($_GET["page"] == "home"){
              include 'view/home.php';
            }
            elseif ($_GET["page"] == "aboutme")
            {
              include 'view/aboutme.php';
            }
            elseif ($_GET["page"] == "schooledit"){
              include 'view/schooledit.php';
            }
            elseif ($_GET["page"] == "departmentlist"){
              include 'view/departmentlist.php';
            }
            elseif ($_GET["page"] == "subjectlist"){
              include 'view/subjectlist.php';
            }
            elseif ($_GET["page"] == "attendancestudent"){
              include 'view/attendancestudent.php';
            }
            elseif ($_GET["page"] == "attendance"){
              include 'view/attendance.php';
            }
            elseif ($_GET["page"] == "exportstaffattendance"){
              include 'view/exportstaffattendance.php';
            }
            elseif ($_GET["page"] == "exportstudentattendance"){
              include 'view/exportstudentattendance.php';
            }
            elseif ($_GET["page"] == "exportclassattendance"){
              include 'view/exportclassattendance.php';
            }


            //view list
            elseif ($_GET["page"] == "stafflist")
            {
              include 'view/stafflist.php';
            }
            elseif ($_GET["page"] == "studentlist")
            {
              include 'view/studentlist.php';
            }
            elseif ($_GET["page"] == "newstudentlist")
            {
              include 'view/newstudentlist.php';
            }
            elseif ($_GET["page"] == "parentlist")
            {
              include 'view/parentlist.php';
            }
            elseif ($_GET["page"] == "newparentlist")
            {
              include 'view/newparentlist.php';
            }
            elseif ($_GET["page"] == "classroomlist")
            {
              include 'view/classroomlist.php';
            }
            elseif ($_GET["page"] == "timetablelist")
            {
              include 'view/timetablelist.php';
            }

            //view detail
            elseif ($_GET["page"] == "staffdetail")
            {
              include 'view/staffdetail.php';
            }
            elseif ($_GET["page"] == "studentdetail")
            {
              include 'view/studentdetail.php';
            }
            elseif ($_GET["page"] == "newstudentdetail")
            {
              include 'view/newstudentdetail.php';
            }
            elseif ($_GET["page"] == "parentdetail")
            {
              include 'view/parentdetail.php';
            }
            elseif ($_GET["page"] == "classdetail")
            {
              include 'view/classdetail.php';
            }
            elseif ($_GET["page"] == "departmentdetail")
            {
              include 'view/departmentdetail.php';
            }

            //model add
            elseif ($_GET["page"] == "changepassword"){
              include 'model/changepassword.php';
            }
            elseif ($_GET["page"] == "logout"){
              include 'model/logout.php';
            }
            elseif ($_GET["page"] == "addstaff"){
              include 'model/addstaff.php';
            }
            elseif ($_GET["page"] == "addstudent"){
              include 'model/addstudent.php';
            }
            elseif ($_GET["page"] == "addparent"){
              include 'model/addparent.php';
            }
            elseif ($_GET["page"] == "addclass"){
              include 'model/addclass.php';
            }
            elseif ($_GET["page"] == "addtimetable"){
              include 'model/addtimetable.php';
            }

            //modal add
            elseif ($_GET["page"] == "modal-changepassword"){
              include 'view/modal-changepassword.php';
            }
            elseif ($_GET["page"] == "modal-addstaff"){
              include 'view/modal-addstaff.php';
            }
            elseif ($_GET["page"] == "modal-addstudent"){
              include 'view/modal-addstudent.php';
            }
            elseif ($_GET["page"] == "modal-addparent"){
              include 'view/modal-addparent.php';
            }
            elseif ($_GET["page"] == "modal-addclass"){
              include 'view/modal-addclass.php';
            }
            elseif ($_GET["page"] == "modal-adddepartment"){
              include 'view/modal-adddepartment.php';
            }
            elseif ($_GET["page"] == "modal-addsubject"){
              include 'view/modal-addsubject.php';
            }

            //model edit
            elseif ($_GET["page"] == "editstaff"){
              include 'model/editstaff.php';
            }
            elseif ($_GET["page"] == "editstudent"){
              include 'model/editstudent.php';
            }
            elseif ($_GET["page"] == "editclass"){
              include 'model/editclass.php';
            }
            elseif ($_GET["page"] == "editclass"){
              include 'model/editclass.php';
            }
            elseif ($_GET["page"] == "edittimetable"){
              include 'model/edittimetable.php';
            }
            elseif ($_GET["page"] == "editparent"){
              include 'model/editparent.php';
            }
            elseif ($_GET["page"] == "editparentduplicate"){
              include 'model/editparentduplicate.php';
            }

            //modal delete
            elseif ($_GET["page"] == "modal-deletestaff"){
              include 'view/modal-deletestaff.php';
            }
            elseif ($_GET["page"] == "modal-deletedepartment"){
              include 'view/modal-deletedepartment.php';
            }
            elseif ($_GET["page"] == "modal-deletesubject"){
              include 'view/modal-deletesubject.php';
            }

            ?>
          <?php
          }
        ?>
      </div>
    </div>
    <!-- LOCAL -->
    <!-- JavaScript -->
    <script type="text/javascript" src="resources/default.js"></script>
  </body>
  </html>
