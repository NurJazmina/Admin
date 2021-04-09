<form action="index.php?page=addnews" method="post" name="AddNews"><br><br>
<div class="table-responsive" style="width:100%; margin:0 auto;">
  <table class="table table-bordered dt-responsive nowrap table-sm table-success" cellpadding="1" cellspacing="0">
    <tbody>
      <tr> 
        <td colspan="9" bgcolor="#31a0a4"><font style="font-family: Arial; font-size: 15px;"><strong>Add record </strong></font></td>
      </tr>
      <tr> 
        <td height="27"><strong><font style="font-family: Arial; font-size: 13px;">Title</font></strong></td>
        <td>
        <input type="text" class="form-control" id="staticStaffNo" name="txttitle" size="200" style="font-family: Verdana, sans-serif; font-size: 13px;  10px;" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required>
        </td>
      </tr>
      <tr> 
        <td><strong><font style="font-family: Arial; font-size: 13px;">Access Type</font></strong></td>
        <td>
        <input type="checkbox" class="radio" name="access" value="SCHOOL1"><label  for="txtstaff">Staff</label>
        <input type="checkbox" class="radio" name="access" value="SCHOOL0"><label for="txtteacher">Teacher</label>
        <input type="checkbox" class="radio" name="access" value="VIP"><label for="txtparent">Parent</label>
        <input type="checkbox" class="radio" name="access" value="PUBLIC" checked><label for="txtpublic">Public</label>
        <p id="text" style="display:none">Checkbox is CHECKED!</p>
        </td>
      </tr>
      <tr> 
        <td colspan="2"><strong><font style="font-family: Arial; font-size: 13px;">News</font></strong><br><br>
        <textarea id="basic-example" name="txtdetail" ></textarea>
        </td>
      </tr>
      <tr> 
        <td height="27" colspan="2"><div align="right"> 
            <button type="submit" class="btn btn-secondary" name="AddNews">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script>
$('input[type="checkbox"]').on('change', function() {
   $(this).siblings('input[type="checkbox"]').prop('checked', false);
});
</script>
</form>

