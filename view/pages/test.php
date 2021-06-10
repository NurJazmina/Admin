
<button id="fpx" type="button" onclick='testing($(this).val());' class="btn btn-primary">test</button>
<script
  src="../js/jquery-3.6.0.min.js"></script>
  
<script>
var body = {};
body.name = "Meowsy";
body.species = "cat";
body.likes = "catnip";
body.dislikes = "zucchini";
var data = data;

function testing(data) {
  return fetch(`http://localhost/smartschool.gongetz.com/new.php`, {
    method: 'post',
    body: JSON.stringify(body)
  })

  .then(response => response.text())
  .then(text => {
    try {
        console.log(text);
        // Do your JSON handling here
    } catch(err) {
       // It is text, do you text handling here
    }
  });
}
</script>
