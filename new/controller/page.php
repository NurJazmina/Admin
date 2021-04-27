
<?php
    if(!isset($_SESSION['loggeduser_id']) && empty($_SESSION['loggeduser_id'])) 
    {
    ?>
        <div class="row" style="height:100vh;">
            <div class="col-sm-12 col-lg-6" style="background-image:url(images/loginpagebg.jpg); background-repeat:no-repeat; background-size:cover;">
            </div>
                <?php include 'view/login.php'; ?>
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
            include 'view/pages/'.$_GET['page'].'.php';
        }
    }
?>