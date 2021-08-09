<?php
$Notes_id = strval($_GET['Notes']);
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($Notes_id)];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.OL_Notes',$query);
foreach ($cursor as $document)
{
    $Subject_id = strval($document->Subject_id);
    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    foreach ($cursor as $document1)
    {
        $SubjectName = $document1->SubjectName;
    }
}
?>
<style>
.btn-link:hover {
    color: #0a477e;
    text-decoration: underline;
    text-decoration-line: underline;
    text-decoration-thickness: initial;
    text-decoration-style: initial;
    text-decoration-color: initial;
}

input[aria-invalid='false'] {
  border: 1px solid #3fc4bc;
}
input[aria-invalid='true'] {
  border: 1px solid #F64E60;
}

.error {
  display: none;
  color: #F64E60;
  font-weight: bold;
  p {
    margin: 0;
  }
}

.info {
  background: #ccc;
  padding: 20px;
  h2 {
    margin: 0 10px;
  }
  code {
    font-size: 18px;
    font-weight: bold;
  }
}

html {
  scroll-behavior: smooth;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid gradient-custom" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-white font-weight-bold my-1 mr-5">Add Announcement</h5>
					<!--end::Page Title-->
				</div>
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Detail-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-white-50 font-weight-bold" id="kt_subheader_total"><?php echo $SubjectName; ?></span>
                </div>
                <!--end::Detail-->
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
            <div class="col-12 col-sm-12 col-sm-12">
                <div class="col-12 col-sm-12 col-lg-12 text-right">
                    <div class="row">
                    </div>
                </div>
            </div>
		</div>
		<!--end::Toolbar-->
	</div>
</div>
<!--end::Subheader-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" name="add_announcement_return_notes" action="index.php?page=ol_notes&id=<?= $Notes_id; ?>&slot=<?= $Note_sort; ?>" method="post">
                    <div class="card-body">
                        <div class="checkbox-inline mb-10">
                            <h2>Adding a New Announcement</h2>
                        </div>
                        <!-- begin::body -->
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <label class="d-inline word-break" for="title">Subject</label>
                                    <div class="ml-1 ml-md-auto d-flex align-items-center align-self-start">
                                        <i class="icon fa fa-exclamation-circle text-danger fa-fw " title="Required" aria-label="Required"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="title" id="title" aria-required="true" aria-invalid="false" data-rule="title" required>
                                    <div class="error" id="titleErrorMessage" aria-hidden="true" role="alert" tabindex="1">
                                        <p> - You must supply a value here !</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                                    <label class="d-inline word-break " for="id_name">Message</label>
                                </div>
                                <div class="col-md-6">
                                    <textarea class="message" name="description" id="description"></textarea>
                                </div>
                            </div>
                        <!-- end::body -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Notes_id" value="<?php echo $Notes_id; ?>">
                                <input type="hidden" class="col-sm-12 col-form-label text-sm-right" name="Subject_id" value="<?php echo $Subject_id; ?>">
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <button type="submit" class="btn btn-success mr-2" name="add_announcement_return_notes">Save and return to the notes</button>
                                <!-- <button type="submit" class="btn btn-success mr-2" onclick="myFunction()">Save and display</button> -->
                                <button type="reset"  class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/jwc9s2y5k97422slkhbv6eu2eqwbwl2skj9npskngzqtsrhq/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
//custom tinymce
tinymce.init({
  selector: '.message',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:50,
});

//invalid input
(function(win, undefined) {
 $(function() {
    var rules = {
      email: function(node) {
        var inputText = node.value,
		inputRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
		return inputRegex.test(inputText);
      },
      title: function(node) {
        var inputText = node.value,
		inputRegex = /^\s*[a-zA-Z0-9,\s]+\s*$/;
		return inputRegex.test(inputText);
      }
    };
    
    function onFocusOut() {
      validate(this);
    }
    
    function validate(node) { 
     var valid = isValid(node),
         $error = $(node).next('.error'); 
      
      if (valid) 
      {
        $(node).attr('aria-invalid', false);
        $error
          .attr('aria-hidden', true)
          .hide();
        $(node).attr('aria-describedby', '');
      } 
      else 
      {
        $(node).attr('aria-invalid', true);
        $error
          .attr('aria-hidden', false)
          .show();
        $(node).attr('aria-describedby', $error.attr('id'));
      }
    }
    
    function isValid(node) {
      return rules[node.dataset.rule](node);
    }
    
    $('[aria-invalid]').on('focusout', onFocusOut);
  });
}(window));

//popover
$(function () {
  $('[data-bs-toggle="popover"]').popover()
})

//groupclass
function Selectgroupmode() {
    var group = document.getElementById("groupmode").value;
    var box = document.getElementById("groupbox");
    if(group == "SEPARATE" || group == "HIDE")
    box.style.display = "block";
    else
    box.style.display = "none";
}
Selectgroupmode();

</script>