<?php
$_SESSION["title"] = "Online learning";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<style>
.firstBackground {
    background-color: rgb(58 177 183);
    color: rgba(255, 255, 255, 1);
}
.firstform {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    height: 10px;
    left: -1px;
    position: absolute;
    top: -1px;
    width: calc(100% + 2px);
}
.allform {
    background-color: red;
    border-radius: 25px;
}
</style>
<div class="row">
<div class="col-2">
    <div class="card">
        <div class="card-header">
        </div>
    </div>
</div>
<div class="col-8">
    <div class="card">
        <div class="card-header allform">
            <div class="firstform firstBackground">
            </div>
        </div>
    </div>
</div>
<div class="col-2">
    <div class="card">
        <div class="card-header">
        </div>
    </div>
</div>

</div>
