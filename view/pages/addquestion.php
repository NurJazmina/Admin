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
<script language="javascript">
localStorage.i = Number(1);

function myevent(action)
{
    var i = Number(localStorage.i);
    var div = document.createElement('div');

    if(action.id == "add")
    {
        localStorage.i = Number(localStorage.i) + Number(1);
        var id = i;
        div.id = id;
    
        div.innerHTML = 
        '<div class="card">'+
            '<div class="card-body">'+
            '<h5 align="left">QUESTION '+id+'</h5>'+
                '<div class="form-group row">'+
                    '<label for="questiontype" class="col-lg-2 col-form-label text-lg-left">TYPE</label>'+
                    '<div class="col-lg-10">'+
                        '<select class="form-control" id="type'+id+'" required>'+
                            '<option>CHOOSE YOUR TYPE</option>'+
                            '<option value="OBJECTIVE">OBJECTIVE</option>'+
                            '<option value="SUBJECTIVE">SUBJECTIVE</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="OBJECTIVE box_'+id+'">'+
                    '<div class="form-group row">'+
                        '<label  class="col-lg-2 col-form-label text-lg-left">OPTION A</label>'+
                        '<div class="col-lg-10">'+
                            '<input class="form-control" type="text" name="option_a" required>'+
                        '</div>'+
                        ' <label  class="col-lg-2 col-form-label text-lg-left">OPTION B</label>'+
                        '<div class="col-lg-10">'+
                            '<input class="form-control" type="text" name="option_b" required>'+
                        '</div>'+
                        '<label  class="col-lg-2 col-form-label text-lg-left">OPTION C</label>'+
                        '<div class="col-lg-10">'+
                            '<input class="form-control" type="text" name="option_c" required>'+
                        '</div>'+
                        '<label  class="col-lg-2 col-form-label text-lg-left">OPTION D</label>'+
                        '<div class="col-lg-10">'+
                            '<input class="form-control" type="text" name="option_d" required>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                    '<label for="questiontype" class="col-lg-2 col-form-label text-lg-left">ANSWER</label>'+
                        '<div class="col-lg-10">'+
                            '<select class="form-control" name="answer" required>'+
                                '<option>CHOOSE CORRECT ANSWER</option>'+
                                '<option value="A">A</option>'+
                                '<option value="B">B</option>'+
                                '<option value="C">C</option>'+
                                '<option value="D">D</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left">DATE START</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="datetime-local" class="form-control" id="staticStaffNo" name="DateStart">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left">DATE END</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="datetime-local" class="form-control" id="staticStaffNo" name="DateEnd">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left" for="quantity">TOTAL MARK</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="number" class="form-control" id="quantity" name="mark" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="SUBJECTIVE box_'+id+'">'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left">SUBJECTIVE</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="text" class="form-control" name="answer" size="200" required>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left">DATE START</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="datetime-local" class="form-control" id="staticStaffNo" name="DateStart">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left">DATE END</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="datetime-local" class="form-control" id="staticStaffNo" name="DateEnd">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-lg-2 col-form-label text-lg-left" for="quantity">TOTAL MARK</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="number" class="form-control" id="quantity" name="mark" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div><div class="separator separator-dashed my-10"></div>'+
            '<div class="row"><div class="col" align="right">'+
            '<button type="submit" id='+id+' class="btn btn-sm" onclick="myevent(this)" value="Delete" /><i class="flaticon-delete icon-md"></i></button>'+
            '</div></div><br>'+
        '</div><br>';

        document.getElementById('AddDel').appendChild(div);
        $(document).ready(function(){
        $("#type"+id).change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box_"+id).not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box_"+id).hide();
                }
            });
        }).change();
        });
    }
    else
    {
        var element = document.getElementById(action.id);
        element.parentNode.removeChild(element);
    }
}
</script>
<form id="AddQuestion" name="AddQuestion" action="index.php?page=modal-recheckstafflist" method="post">
<div class="row">
    <div class="col-2">
    </div>
    <div class="col-8 py-1">
        <div class="col">
            <div class="card mb-2">
                <div class="card-header allform">
                    <div class="firstform firstBackground">
                    </div>
                    <div class="text">
                    <label class="col-lg-12 col-form-label text-lg-center"><h3>TITLE</h3></label>
                    <textarea class="notesdetail" name="title" required></textarea>
                    </div>
                    <div class="col-lg-12 mt-5" id="AddDel" align="right">
                        <input type="button" class="btn btn-success btn-sm" id="add" onclick="myevent(this)" value="Add Question" data-toggle="tooltip" title="Add more question!"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card-footer">
                <div class="col-lg-12 ml-lg-auto" align="right">
                    <button type="submit" class="btn btn-success" name="AddQuestion">Confirm</button>
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
  selector: '.notesdetail',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:10,
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>