
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("input").keyup(function(){
        var name = $("input").val();
        $.post("view/pages/likes.php", {
            like: name
        }, function(data, status){
            $("#test").html(data);
        });
    });

});
</script>

<input type="text" name="name" class="form-control">
<p id="test"></p>
