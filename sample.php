<h1>Sample</h1>
<?php
$xcount = 3;
$ycount[0] = 120;
$ycount[1] = 340;
$ycount[2] = 260;
$varrepeat = 0;
$varycounting = 0;
do 
{
    ?>
    <div style="float:left;width:100px;border:1px solid #ccc;height:<?php echo $ycount[$varycounting]; ?>"px;"></div>
    <?php
    $varycounting = $varycounting + 1;
    $varrepeat = $varrepeat + 1;
} 
while ($xcount!=$varrepeat)
?>