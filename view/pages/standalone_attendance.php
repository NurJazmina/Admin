<?php 
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#Date").click(function() {
    
    var date = $("#date").val();
    var school = $("#school").val();

        $.post("date.php", {
            date: date,
            school:school,
        },
        function(data, status){
            $("#test").html(data);
        },
        );
        $(this).removeClass('btn-light').addClass('btn-success');
    });
});
</script>
<div class="card">
    <div class="card-body text-right">
        <div class="form-group row">
            <input type="hidden" id="school" value="<?= $_SESSION["loggeduser_school_id"]; ?>">
            <input type="date" class="form-control bg-white" name="date" id="date" placeholder="Select date" value="<?= $date; ?>"> 
            <button type="button" class="btn btn-sm btn-light" id="Date"></a>submit</button>
        </div>
        <div class="form-group row">
            <a id="test">
        </div>
        
    </div>
</div>