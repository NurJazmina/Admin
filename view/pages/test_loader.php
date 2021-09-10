<?php 
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
?>
<style>
    #loader {
        border: 12px solid #f3f3f3;
        border-radius: 50%;
        border-top: 12px solid #1BC5BD;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }
        
    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }
        
    .center {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $("#Date").click(function() {

        var date = $("#date").val();
        var school = $("#school").val();

        $.post("test.php", {
            date: date,
            school:school,

        beforeSend: function(){
            // Show image container
            $("#loader").hide();
        },

        complete:function(data){
            // Hide image container
            $("#loader").show();
        }
        
        },
        function(data, status){
            $("#test").html(data);
            $("#loader").hide();
        },
        );
        $(this).removeClass('btn-light').addClass('btn-success');
    });

});
</script>

<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <div class="form-group row">
                <input type="hidden" id="school" value="<?= $_SESSION["loggeduser_school_id"]; ?>">
                <input type="date" class="form-control bg-white" name="date" id="date" placeholder="Select date" value="<?= $date; ?>"> 
                <button type="button" class="btn btn-sm btn-light" id="Date">submit</button>
            </div>
            <div class="form-group row">
                <div id='loader' style='display: none;' class="center"></div>
                <a id="test"></a>
            </div>
        </div>
    </div>
</div>