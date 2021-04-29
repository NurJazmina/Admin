<?php
    //$category = ($_GET['forum']);
    //$topic = ($_GET['topic']);
?>
<?php
$_SESSION["title"] = "Forum";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<form action="index.php?page=schoolforum&forum=<?php echo $sort; ?>&topic=<?php echo $topic; ?>" method="post" name="AddForums"><br><br>
<div class="table-responsive" style="width:100%; margin:0 auto;">
  <table class="table table-bordered dt-responsive nowrap table-sm table-success" cellpadding="1" cellspacing="0" style="font-family: Arial; color:#505050; font-size: 15px;">
    <tbody>
      <tr> 
        <td colspan="9"><strong>ADD RECORD</strong></td>
      </tr>
      <tr> 
        <td height="27"><strong>TITLE</strong></td>
        <td>
        <input type="text" class="form-control" id="staticStaffNo" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
        </td>
      </tr>
      <tr> 
        <td colspan="2"><strong>FORUMS</strong><br><br>
        <textarea id="basic-example" name="txtdetail" ></textarea>
        </td>
      </tr>
      <tr> 
        <td height="27" colspan="2"><div align="right"> 
            <input type="hidden"  name="txtforum" value="<?php echo  $category; ?>">
            <button type="submit" class="btn btn-secondary" name="AddForums">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</form>