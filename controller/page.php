<?php
$allowed_access = array("dashboard",);


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
            if (in_array($_GET['page'], $allowed_access))
            {
                include 'view/pages/'. $_GET['page'] . ".php";
            }
            else 
            {
                include 'view/pages/unauthorized.php';
            }
        }
        else 
        {
            include 'view/partials/error.html';
        }
    }   
}
?>