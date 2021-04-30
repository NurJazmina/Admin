
<style>
@import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");

* {
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    box-sizing: border-box;
    color: inherit;
}

body {
    background-color:#ffffff;
}

h1 {
    font-size: 45vw;
    text-align: center;
    position: fixed;
    width: 100vw;
    z-index: 1;
    color: #ffffff26;
    text-shadow: 0 0 50px rgba(0, 0, 0, 0.07);
    top: 50%;
    transform: translateY(-50%);
    font-family: "Montserrat", monospace;
}

.abc {

    width: 70vw;
    position: absolute;
    top: 450px;
    left: 450px;
    transform: translateY(-50%);
    margin: 0 auto;
    padding: 30px 100px 80px;
    box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);
    z-index: 3;
}

P {
    font-family: "Share Tech Mono", monospace;
    color: #f5f5f5;
    margin: 0 0 20px;
    font-size: 17px;
    line-height: 1.2;
}

span {
    color: #f0c674;
}

i {
    color: #8abeb7;
}

div a {
    text-decoration: none;
}

b {
    color: #81a2be;
}

@keyframes slide {
    from {
        right: -100px;
        transform: rotate(360deg);
        opacity: 0;
    }
    to {
        right: 15px;
        transform: rotate(0deg);
        opacity: 1;
    }
}

</style>

<br><br><br>
<div class="abc">
<p>> <span>ERROR CODE</span>: "<i>HTTP 403 Forbidden</i>"</p>
<p>> <span>ERROR DESCRIPTION</span>: "<i>Access Denied. You Do Not Have The Permission To Access This Page On This Server</i>"</p>
<p>> <span>ERROR POSSIBLY CAUSED BY</span>: [<b>You do not have permission to modify the following pages : Staff, Student, Parent, News, Event, Department, Subject and Class</b>...]</p>

<p>> <span>REDIRECT TO OUR PAGE</span>: 
[<a href="index.php?page=dashboard">Home Page</a>, 
<a href="index.php?page=schoolabout">About Us</a>, ...]
</p>

<p>> 
  <span>HAVE A NICE DAY  <?php echo $_SESSION["loggeduser_consumerFName"]; ?> :-)</span>
</p>
</div>

<script>
var str = document.getElementsByTagName('div.abc')[0].innerHTML.toString();
var i = 0;
document.getElementsByTagName('div.abc')[0].innerHTML = "";

setTimeout(function() {
    var se = setInterval(function() {
        i++;
        document.getElementsByTagName('div.abc')[0].innerHTML = str.slice(0, i) + "|";
        if (i == str.length) {
            clearInterval(se);
            document.getElementsByTagName('div.abc')[0].innerHTML = str;
        }
    }, 10);
},0);

</script>


