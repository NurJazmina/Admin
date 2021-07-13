<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<h1>JSON IN JAVASCRIPT</h1>
<script type="text/javascript">
var emps = [];
var emp1 = {};
var emp2 = {};

emp1.id = 1;
emp1.name = "Amira";
emp1.addr = "kelantan";
emps.push(emp1);

emp2.id = 2;
emp2.name = "Athifah";
emp2.addr = "terengganu";
emps.push(emp2);

console.log(emps)
$.ajax({
    url:"view/pages/fetch.php",
    method:"post",
    data:{emps : JSON.stringify( emps )},
    success: function(res){
        console.log(res);
        $("#data").html(res);
    }
})
</script>
<div id="data"></div>
