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

  <!--begin::Head-->
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Smart School</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--begin::Page Style(used by this page)-->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="resources/default.css">
    <!--end::Page Style(used by this page)-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <!-- begin::Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- end::Bootstrap CSS -->
    <!--begin::Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/v4-shims.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!--end::Fonts-->
    <!--end::Global Theme Bundle(used by all pages)-->

  </head>
  <!--end::Head-->

  <!--begin::Body-->
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
          /**forum can be access without need to login */
          if ($_GET["page"] == "forum"){
            include 'view/forum.php';
          }
          if ($_GET["page"] == "forumschoolforumgeneral"){
            include 'view/forumschoolforumgeneral.php';
          }
          if ($_GET["page"] == "schoolforumproposal"){
            include 'view/index.php?page=schoolforumproposal.php';
          }
          if ($_GET["page"] == "schoolforumshortnews"){
            include 'view/index.php?page=schoolforumshortnews.php';
          }
          /**
            * @todo Tambah untuk forum public
            * @body Rujuk view/forum.php.
            */
          if(!isset($_SESSION["loggeduser_schoolID"]) && empty($_SESSION["loggeduser_schoolID"]))
          {
            include 'view/login.php'; 
          }
          else
          {
            if (!isset($_GET['page']) || empty($_GET['page'])){
              include 'view/home.php';
            }
            elseif ($_GET["page"] == "home"){
              include 'view/home.php';
            }
            elseif ($_GET["page"] == "aboutme")
            {
              include 'view/aboutme.php';
            }
            elseif ($_GET["page"] == "modal-changepassword"){
              include 'view/modal-changepassword.php';
            }
            elseif ($_GET["page"] == "changepassword"){
              include 'model/changepassword.php';
            }
            elseif ($_GET["page"] == "logout"){
              include 'model/logout.php';
            }
            elseif ($_GET["page"] == "schoolinfo"){
              include 'view/schoolinfo.php';
            }
            elseif ($_GET["page"] == "news")
            {
              include 'view/news.php';
            }
            elseif ($_GET["page"] == "newsdetail")
            {
              include 'view/newsdetail.php';
            }
            elseif ($_GET["page"] == "modalevent"){
              include 'view/modal-event.php';
            }
            elseif ($_GET["page"] == "event")
            {
              include 'view/event.php';
            }
            elseif ($_GET["page"] == "eventdetail")
            {
              include 'view/eventdetail.php';
            }
            elseif ($_GET["page"] == "modalnews"){
              include 'view/modal-news.php';
            }
            elseif ($_GET["page"] == "departmentlist"){
              include 'view/departmentlist.php';
            }
            elseif ($_GET["page"] == "subjectlist"){
              include 'view/subjectlist.php';
            }
            elseif ($_GET["page"] == "stafflist")
            {
              include 'view/stafflist.php';
            }
            elseif ($_GET["page"] == "studentlist")
            {
              include 'view/studentlist.php';
            }
            elseif ($_GET["page"] == "parentlist")
            {
              include 'view/parentlist.php';
            }
            elseif ($_GET["page"] == "classroomlist")
            {
              include 'view/classroomlist.php';
            }
            elseif ($_GET["page"] == "timetablelist")
            {
              include 'view/timetablelist.php';
            }
            //recheck
            elseif ($_GET["page"] == "recheckstafflist")
            {
              include 'view/modal-recheckstafflist.php';
            }
            elseif ($_GET["page"] == "recheckstudentlist")
            {
              include 'view/modal-recheckstudentlist.php';
            }
            elseif ($_GET["page"] == "recheckparentlist")
            {
              include 'view/modal-recheckparentlist.php';
            }
            elseif ($_GET["page"] == "recheckclassroomlist")
            {
              include 'view/modal-recheckclassroomlist.php';
            }
            elseif ($_GET["page"] == "rechecktimetablelist")
            {
              include 'view/modal-rechecktimetablelist.php';
            }
            //export
            elseif ($_GET["page"] == "exportstaffattendance"){
              include 'view/exportstaffattendance.php';
            }
            elseif ($_GET["page"] == "exportstudentattendance"){
              include 'view/exportstudentattendance.php';
            }
            elseif ($_GET["page"] == "exportclassattendance"){
              include 'view/exportclassattendance.php';
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
            elseif ($_GET["page"] == "editparentduplicate"){
              include 'model/editparentduplicate.php';
            }
          }
        ?>
      </div>
    </div>

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <!--end::Global Theme Bundle(used by all pages)-->
    
    <!--begin::Page Scripts(used by this page)-->
    <?php include 'resources/default.php'; ?>
    <!--end::Page Scripts(used by this page)-->
    <script id="dsq-count-scr" src="//smartschoolgongetz.disqus.com/count.js" async></script>

  </body>
  <!--end::Body-->
</html>
