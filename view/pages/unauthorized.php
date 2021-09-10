<!--begin::Error-->
<div class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 mt-10" style="background-image: url(assets/media/error/bg1.jpg);">
    <!--begin::Content-->
    <div class="card p-10 m-10">
        <div class="row">
        <p class="font-size-h3 text-muted font-weight-normal">OOPS! Something went wrong here</p>
            <div class="col-2">
                <p class="text-secondary">ERROR CODE</p>
                <p class="text-secondary">ERROR DESCRIPTION</p>
                <p class="text-secondary">ERROR POSSIBLY CAUSED BY</p>
                <p class="text-secondary">REDIRECT TO OUR PAGE</p>
                <p class="text-secondary">HAVE A NICE DAY</p>
            </div>
            <div class="col-10">
                <p class="text-primary"> HTTP 403 Forbidden</p>
                <p class="text-primary"> Access Denied. You Do Not Have The Permission To Access This Page On This Server</p>
                <p class="text-primary"> You Do Not Have Permission To Modify The Following Pages : Staff, Student, Parent, News, Event, Department, Subject, Class, and Online Learning</p>
                <p class="text-primary"><a href="index.php?page=dashboard">Home Page</a>, <a href="index.php?page=schoolabout">About Us</a></p>
                <p class="text-primary"><?php echo $_SESSION["loggeduser_consumerFName"]." ".$_SESSION["loggeduser_consumerLName"]; ?></p>
            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
<!--end::Error-->



