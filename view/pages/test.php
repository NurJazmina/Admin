
  <title>Random AJAX Welcome</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script>
    $(function(){
        $('body').css('background','wheat');
        $('#mybtn').on('click', function(e){
        alert('Button clicked'); //<==========================
        e.preventDefault();
        $('#mybtn').fadeOut(300);

        $.ajax({
            url: 'ajax.php',
            type: 'post',
            data: 'test=Hello',
            success: function(d){
                alert(d);
            }
        }); // end ajax call
      })});
</script>

  <script>
    function getWelcome(){

      var ajaxRequest = new XMLHttpRequest();
      ajaxRequest.onreadystatechange = function(){

        if(ajaxRequest.readyState == 4){
          //the request is completed, now check its status
          if(ajaxRequest.status == 200){
            //turn JSON into array
            var messagesArray = JSON.parse(ajaxRequest.responseText);

            //get random object from array
            var randomIndex = Math.floor(Math.random()*messagesArray.length);
            var messageObj = messagesArray[randomIndex];

            //use that object to set content and color
            var welcomeDiv = document.getElementById("welcome");
            welcomeDiv.innerHTML = messageObj.text;
            welcomeDiv.style.color = messageObj.color;	
          }
          else{
            console.log("Status error: " + ajaxRequest.status);
          }
        }
        else{
          console.log("Ignored readyState: " + ajaxRequest.readyState);
        }
      }
      ajaxRequest.open('GET', 'https://happycoding.io/tutorials/javascript/example-ajax-files/random-welcomes.json');
      ajaxRequest.send();
    }
	
  </script>	
<body onload="getWelcome()">
  <div id="welcome"></div>
  <p>This is an example website.</p>
</body>

<?php
    $recd = $_POST['test'];
    echo 'PHP side received: ' . $recd;
?>
