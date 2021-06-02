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

</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script> 
<form id="AddStaffFormSubmit" name="AddStaffFormSubmit" action="index.php?page=modal-recheckstafflist" method="post">
<div class="row">
<div class="col-2">
</div>
<div class="col-8">
<div class="col">
    <div class="card">
        <div class="card-header allform">
            <div class="firstform firstBackground">
            </div>
            <div class="text">
            <label class="col-lg-12 col-form-label text-lg-center"><h5>TITLE QUESTION</h5></label>
            <textarea class="notes" name="title" required></textarea>
            </div>
            <div class="text">
            <label class="col-lg-12 col-form-label text-lg-center"><h5>QUESTIONS DESCRIPTION</h5></label>
            <textarea class="notesdetail" name="title" required></textarea>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="questiontype" class="col-lg-2 col-form-label text-lg-left">QUESTION TYPE</label>
                <div class="col-lg-10">
                    <select class="form-control" id="type" required>
                        <option>CHOOSE YOUR QUESTION</option>
                        <option value="OBJECTIVE">OBJECTIVE</option>
                        <option value="SUBJECTIVE">SUBJECTIVE</option>
                    </select>
                </div>
            </div>
            <div class="OBJECTIVE box">
                <div class="form-group row">
                    <label  class="col-lg-2 col-form-label text-lg-left">OPTION A</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="option_a" required>
                    </div>
                    <label  class="col-lg-2 col-form-label text-lg-left">OPTION B</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="option_b" required>
                    </div>
                    <label  class="col-lg-2 col-form-label text-lg-left">OPTION C</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="option_c" required>
                    </div>
                    <label  class="col-lg-2 col-form-label text-lg-left">OPTION D</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="option_d" required>
                    </div>
                </div>
                <div class="form-group row">
                <label for="questiontype" class="col-lg-2 col-form-label text-lg-left">ANSWER</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="answer" required>
                            <option>CHOOSE YOUR ANSWER</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-left">DATE START</label>
                    <div class="col-lg-10">
                        <input type="datetime-local" class="form-control" id="staticStaffNo" name="DateStart">
                    </div>
                </div>
                <div class="form-group row"> 
                    <label class="col-lg-2 col-form-label text-lg-left">DATE END</label>
                    <div class="col-lg-10">
                        <input type="datetime-local" class="form-control" id="staticStaffNo" name="DateEnd">
                    </div>
                </div>
                <div class="form-group row"> 
                    <label class="col-lg-2 col-form-label text-lg-left" for="quantity">TOTAL MARK</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="quantity" name="mark" min="0" max="100">
                    </div>
                </div>
            </div>
            <div class="SUBJECTIVE box">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-left">SUBJECTIVE</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="answer" size="200" required>   
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-left">DATE START</label>
                    <div class="col-lg-10">
                        <input type="datetime-local" class="form-control" id="staticStaffNo" name="DateStart">
                    </div>
                </div>
                <div class="form-group row"> 
                    <label class="col-lg-2 col-form-label text-lg-left">DATE END</label>
                    <div class="col-lg-10">
                        <input type="datetime-local" class="form-control" id="staticStaffNo" name="DateEnd">
                    </div>
                </div>
                <div class="form-group row"> 
                    <label class="col-lg-2 col-form-label text-lg-left" for="quantity">TOTAL MARK</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="quantity" name="mark" min="0" max="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-2">
</div>
</div>
</form>     
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.notes',
  content_css : "resources/default.css", 
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:10,
});

tinymce.init({
  selector: '.notesdetail',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:10,
});
</script>