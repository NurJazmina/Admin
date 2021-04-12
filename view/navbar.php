<div style ="background-color:#31a0a4; color:#FFFFFF;" class="site-header">
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <img class="logo-header" src="image/logo.png" width="50" height="50" alt="logo-header"> <a class="navbar-brand" href="#">SMART SCHOOL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon";><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><i class="fas fa-home" style="font-size:15px"></i> Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">School</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li ><a class="dropdown-item" href="index.php?page=schoolinfo" style="color:#076d79;">School Info</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">News</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li ><a class="dropdown-item" href="index.php?page=news" style="color:#076d79;">News List</a></li>
            <li ><a class="dropdown-item" href="index.php?page=modalnews" style="color:#076d79;">Add News</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Department</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li ><a class="dropdown-item" href="index.php?page=departmentlist" style="color:#076d79;">Department List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Subject</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li ><a class="dropdown-item" href="index.php?page=subjectlist" style="color:#076d79;">Subject List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Staff
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=stafflist" style="color:#076d79;">Staff List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Student
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=studentlist" style="color:#076d79;">Student List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Parent
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=parentlist" style="color:#076d79;">Parent List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Classroom
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=classroomlist" style="color:#076d79;">Classroom List</a></li>
          </ul>
        </li>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Timetable
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=timetablelist" style="color:#076d79;">Timetable List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile <?php echo $_SESSION["loggeduser_consumerFName"]; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item"   href="index.php?page=home"  data-bs-toggle="modal" data-bs-target="#ChangePasswordModal" style="color:#076d79;">Change Password</a></li>
            <li><a class="dropdown-item" href="index.php?page=aboutme" style="color:#076d79;">About Me</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="model/logout.php" style="color:#076d79;">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
