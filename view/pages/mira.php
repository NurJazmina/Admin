<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

    var toggleText = $("#ip").val();
    var name = $("#loguser-id").val();
    var url_likes = $("#url-likes").val();
    var check = $("#check").val();

    if ($("#ip").val() == '0') 
    {
       toggleText = $("#ip").val();
       $("#test").html(check);
       $("#ip").val('1');
    }

    $("#ipclear").click(function() {

            if  ($("#ip").val() == '1') 
            {
                toggleText = $("#ip").val();

                $.post("model/likes.php", {
                like: '1',
                Consumer_id: name,
                url_likes: url_likes
                },
                function(data, status){
                    $("#test").html(data);
                },
                );
                $("#ip").val('2');
                $("#ip").prop("disabled", false);
                $(this).removeClass('btn-light').addClass('btn-success');
            }
            else if ($("#ip").val() == '2') 
            {
                $("#ip").val(toggleText);

                $.post("model/likes.php", {
                like: '0',
                Consumer_id: name,
                url_likes: url_likes
                }, 
                function(data, status){
                    $("#test").html(data);
                });
                $("#ip").val('1');
                $("#ip").prop("disabled", false);
                $(this).removeClass('btn-success').addClass('btn-light');
            }
        });

});
</script>
<?php
$URL_LIKES = "$_SERVER[REQUEST_URI]";
$havedata = 0;
$total_likes = 0;
$filter = ['url'=> $URL_LIKES];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
foreach ($cursor as $document)
{
    $Consumer = $document->Consumer;
    $total_likes = count((array)$Consumer);
}

$filter = ['url'=> $URL_LIKES, 'Consumer.Consumer_id'=> $_SESSION["loggeduser_id"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Likes',$query);
foreach ($cursor as $document)
{
    $havedata = 1;
    $Consumer = $document->Consumer;
    $total_likes = count((array)$Consumer);
}
?>
<input type="hidden" id="ip" value="0">
<input type="hidden" id="loguser-id" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
<input type="hidden" id="url-likes" value="<?php echo $URL_LIKES; ?>">
<input type="hidden" id="check" value="<?php echo $total_likes;?>">
<?php 
if ($havedata==0) 
{
    ?>
    <button type="button" class="btn btn-light far fa-kiss-wink-heart icon-xl" id="ipclear">
        <a id="test"></a>
    </button>
    <?php
} 
else 
{
    ?>
    <button type="button" class="btn btn-success far fa-kiss-wink-heart icon-xl" id="ipclear">
        <a id="test"></a>
    </button>
    <?php
}
?>
<br>
<?php
$filter = ['_id'=>new \MongoDB\BSON\ObjectId('60e545f7fdde22274bae6f44')];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Quiz',$query);
foreach ($cursor as $document)
{
    $Title = $document->Title;
    $Quiz = $document->Quiz;
    $Total_Question = count((array)$Quiz);
}
shuffle($Quiz);
for ($i = 0; $i < $Total_Question; $i++)
{
    $id = $i;
    print_r ($Quiz[$i]->id);
    print_r ($Quiz[$i]->Type);
    echo " --> $id<br>";
}
?>
<!-- testing  -->
testttt docker pull push