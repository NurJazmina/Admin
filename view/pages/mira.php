<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

  var toggleText = $("#ip").val();
  var name = $("#name").val();
  $("#ipclear").click(function() {
        if ($("#ip").val() != '1') 
        {
            toggleText = $("#ip").val();

            $.post("view/pages/likes.php", {
            like: '1',
            Consumer_id: name
            },
            function(data, status){
                $("#test").html(data);
            },
            );
            $("#ip").val('1');
            $("#ip").prop("disabled", false);
                $(this).removeClass('btn-light').addClass('btn-success');
        }
        else
        {
            $("#ip").val(toggleText);

            $.post("view/pages/likes.php", {
            like: '0',
            Consumer_id: name
            }, 
            function(data, status){
                $("#test").html(data);
            });

            $("#ip").prop("disabled", false);
                $(this).removeClass('btn-success').addClass('btn-light');
        }
    });

});
</script>
<div class="input-group">
    <div class="row">
        <div class="col-sm-12">
            <input type="hidden" id="ip" value="0">
            <input type="hidden" id="name" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
            <button type="button" class="btn far fa-kiss-wink-heart icon-xl" id="ipclear">
                <a id="test"></a>
            </button>
        </div>
    </div>
</div>