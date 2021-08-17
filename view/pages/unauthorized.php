<div class="card p-10 m-10">
    <div class="col-lg-12">
        <p class="text-secondary"> <span>ERROR CODE</span>: <i class="text-primary">HTTP 403 Forbidden</i></p>
        <p class="text-secondary"> <span>ERROR DESCRIPTION</span>: <i class="text-primary">Access Denied. You Do Not Have The Permission To Access This Page On This Server</i></p>
        <p class="text-secondary"> <span>ERROR POSSIBLY CAUSED BY</span>: [<b class="text-primary">You do not have permission to modify the following pages : Staff, Student, Parent, News, Event, Department, Subject and Class</b>...]</p>

        <p class="text-secondary"> <span>REDIRECT TO OUR PAGE</span>: 
        [<a href="index.php?page=dashboard">Home Page</a>, <a href="index.php?page=schoolabout">About Us</a>, ...]
        </p>

        <p><span>HAVE A NICE DAY  <?php echo $_SESSION["loggeduser_consumerFName"]; ?> :-)</span></p>
    </div>
</div>



