<!-- live chat start-->
<style>
   body {
        /* background-image: url('image/student.jpg'); */
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Ubuntu', sans-serif;
    }
    
    .main {
        background-color: #FFFFFF;
        width: 400px;
        height: 570px;
        padding:10px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    
    }
    
    .sign {
        padding-top: 25px;
        color: #8C55AA;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 23px;
    }
    
    .un {
    width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
    form.form1 {
        padding-top: 25px;
        font-size: 12px;
    }
    
    .pass {
            width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
   
    .un:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
        
    }
    
    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }
    
    .forgot {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        padding-top: 15px;
    }
    .dev {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        padding-bottom: 20px;
    }
    
    a {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-decoration: none
    }
    
    @media (max-width: 600px) {
        .main {
        width: auto;
        height: auto;  
        background-size: 50%;
        border-radius: 0px;
        }
        
      body {
        background-image: url('image/student.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
      }
      
    }
</style>
<div class="main">
  <div align="center">
    <img src="image/logogongetz.png" width="132" height="145" style="padding-top: 20px;">
  </div>
  
  <p class="sign" align="center">Sign in to<br />SmartSchool Go N Getz</p>
  <form class="form1" name="frmlogin" method="post" action="">
    <input class="un " type="text" align="center" id="txtID" name="txtID" placeholder="Your ID">
    <input class="pass" type="password" align="center" id="txtPassword" name="txtPassword" placeholder="Password" >
    <button id="login" type="button" class="submit" align="center"  name="LoginFormSubmit">Sign in</button>
    <p class="forgot" align="center"><a href="#">1st Time Login</a> | <a href="#">Forgot Password?</a></p>
    <p class="dev" align="center">Developed by G&G Softech Sdn Bhd</p>
  </form>
</div>
<script>
   document.addEventListener('click', ({ target }) => {
    if (target.matches('button')) {
      var id = document.getElementById('txtID').value;
      var passwd = document.getElementById('txtPassword').value;
      var formData = new FormData();
      var postData = {};
      postData.nric = id;
      postData.password = passwd;
      var json = JSON.stringify(postData);
      return fetch(`http://8ce958c31199.ngrok.io/api/login`, {
              method: 'post',
              headers: {
                'Accept': '*/*',
                'Content-Type': 'application/json',
              },
              body: json
            })
            .then(response => {
              if (!response.ok) {
                throw new Error(response.statusText);
              }
              
              return response.text();
            })
            .then(text => {
              console.log(text);
              var json = JSON.parse(text);
              var token = json.data.token;
              var url = `http://localhost:7070/api/api_session.php?api_session=` + token;
              return fetch(url, {
                  method: 'get',
              })
              .then(response => {
                if (!response.ok) {
                  throw new Error(response.statusText);
                }
                return response.text();
              })
              .then(text => {
                window.location.href = 'http://localhost:7070/index.php?page=dashboard&action=loginsuccesful';
              })
              .catch(error => {
                console.log(error);
              });
              
            })
            .catch(error => {
                console.log(error);
            });
    }
});
</script>
    </div>