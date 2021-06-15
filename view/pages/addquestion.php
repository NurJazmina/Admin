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
/* Set up general layout rules for outer containers. */
.contact-form,
.results {
  width: 200vw;
  max-width: 550px;
  margin: 8vh auto;
}

p {
  margin-top: 0.5rem;
  font-size: 87.5%;
}

.results pre {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background: $color-lightest;
  border: 1px solid var(--color-gray-light);
  overflow-x: scroll;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
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
                    '<label for="questiontype" class="col-sm-2 col-form-label text-sm-right">TYPE</label>'+
                    '<div class="col-sm-10">'+
                        '<select class="form-control" id="type'+id+'" name="Type" required>'+
                            '<option>CHOOSE YOUR TYPE</option>'+
                            '<option value="OBJECTIVE">OBJECTIVE</option>'+
                            '<option value="SUBJECTIVE">SUBJECTIVE</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="OBJECTIVE box_'+id+'" id="Quiz">'+
                    '<div class="form-group row">'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION A</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_A" name="Option_A">'+
                        '</div>'+
                        ' <label  class="col-sm-2 col-form-label text-sm-right">OPTION B</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_B" name="Option_B">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION C</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_C" name="Option_C">'+
                        '</div>'+
                        '<label  class="col-sm-2 col-form-label text-sm-right">OPTION D</label>'+
                        '<div class="col-sm-10">'+
                            '<input class="form-control" type="text" id="Option_D" name="Option_D">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                    '<label for="questiontype" class="col-sm-2 col-form-label text-sm-right">ANSWER</label>'+
                        '<div class="col-sm-10">'+
                            '<select class="form-control" id="Answer" name="Answer" >'+
                                '<option value="Option_A" >A</option>'+
                                '<option value="Option_B" >B</option>'+
                                '<option value="Option_C" >C</option>'+
                                '<option value="Option_D" >D</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right" for="Mark">TOTAL MARK</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="number" class="form-control" id="Mark" name="Mark" min="0" max="100">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="SUBJECTIVE box_'+id+'" id="Quiz">'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right">SUBJECTIVE</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="text" class="form-control" id="Answer" name="Answer" size="200">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label text-sm-right" for="quantity">TOTAL MARK</label>'+
                        '<div class="col-sm-10">'+
                            '<input type="number" class="form-control" id="quantity" name="Mark" min="0" max="100">'+
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
<div class="results" align="center">
    <h2>Form Data</h2>
    <pre></pre>
</div>
<?php
$date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
?>
<section class="contact-form">
<form>
    <div class="card card-custom card-stretch">
        <div class="container">
            <div align="center">
                <label class="col-form-label"><h3>TITLE</h3></label>
                <textarea class="notesdetail" name="title"></textarea><br>
                
                <input type="hidden" id="School_id" name="School_id" value="<?php echo $date; ?>">
                <div class="form-group row">
                    <label for="txtclasscategory" class="col-sm-2 col-form-label">SUBJECT</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="sltStatus" name="Subject_id">
                    <?php
                    $filter = ['Teacher_id'=>$_SESSION["loggeduser_teacherid"]];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                    foreach ($cursor as $document)
                    {
                        $id = strval($document->_id);
                        $Subject_id = strval($document->Subject_id);

                        $filter = ['_id'=> new \MongoDB\BSON\ObjectID($Subject_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                        foreach ($cursor as $document)
                        {
                            $SubjectName = strval($document->SubjectName);
                        ?>
                        <option value="<?=$Subject_id?>"><?=$SubjectName?></option>
                        <?php
                        }
                    }
                    ?>
                    </select>
                    </div>
                </div>
                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Created_by" name="Created_by" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Created_date" name="Created_date" value="<?php echo $date; ?>">
                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Edit_by" name="Edit_by" value="<?php echo $_SESSION["loggeduser_id"]; ?>">
                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Edit_date" name="Edit_date" value="<?php echo $date; ?>">
                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" id="Total_question" name="Total_question" value="<?php echo "3"; ?>">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-sm-right">DATE START</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="Start_date" name="Start_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-sm-right">DATE END</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="End_date" name="End_date">
                    </div>
                </div>
                
                <div class="mt-5" id="AddDel" align="right">
                    <input type="button" class="btn btn-success btn-sm" id="add" onclick="myevent(this)" value="Add Question" data-toggle="tooltip" title="Add more question!"/>
                    <div class="separator separator-dashed my-10"></div>
                </div>
                <div class="separator separator-dashed my-10"></div>
                <div align="right">
                    <button type="submit" class="btn btn-secondary btn-sm" onclick='TestingForm();'>Confirm!</button>
                </div><br>
            </div>
        </div>
    </div>
</form> 
</section>    
<script>
    function TestingForm(event) {
    event.preventDefault();
    
    const data = new FormData(event.target);
    
    const formJSON = Object.fromEntries(data.entries());
    // for multi-selects, we need special handling
    formJSON.Quiz = data.getAll('Quiz');

    // Object
    var b = [{      
        "Option_A": "a",
        "Option_D": "b"
    },{      
        "Option_A": "c",
        "Option_D": "d"
    }];
    
    var c = data.getAll('Mark');
    for (i = 0; i < 1; i++) {
        formJSON.Quiz.push(b[i]);
    }

    // Array
    //var stuff = [];
    //stuff.push('a');
    const results = document.querySelector('.results pre');
    results.innerText = JSON.stringify(formJSON, null, 2);

    return fetch(`http://localhost/smartschool.gongetz.com/new.php`, {
        method: 'post',
        body: results.innerText
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

    const form = document.querySelector('.contact-form');
    form.addEventListener('submit', TestingForm);
</script>
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