<form action="index.php?page=event" method="post" name="AddNews"><br><br>
<div class="table-responsive" style="width:100%; margin:0 auto;">
  <table class="table table-bordered dt-responsive nowrap table-sm table-success" cellpadding="1" cellspacing="0" style="font-family: Arial; color:#505050; font-size: 15px;">
    <tbody>
      <tr> 
        <td colspan="9"><strong>ADD RECORD</strong></td>
      </tr>
      <tr> 
        <td height="27"><strong>TITLE</strong></td>
        <td><input type="text" class="form-control" id="staticStaffNo" name="txttitle" size="200" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required></td>
      </tr>
      <tr> 
        <td><strong>ACCESS TYPE</strong></td>
        <td>
        <select class="form-control" id="staticStaffNo" name="txtaccess" required>
          <option value="PUBLIC">PUBLIC</option>
          <option value="SCHOOL1">STAFF</option>
          <option value="SCHOOL0">TEACHER</option>
          <option value="VIP">PARENT</option>
        </select>
        </td>
      </tr>
      <tr>
        <td><strong>VENUE</strong></td>
        <td><input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventVenue"></td>
      </tr>
      <tr>
        <td><strong>LOCATION</strong></td>
        <td><input type="text" class="form-control"  id="staticStaffNo" name="txtschoolEventLocation"></td>
      </tr>
      <tr>
        <td><strong>EVENT START</strong></td>
        <td><input type="datetime-local" id="staticStaffNo" name="txtSchoolEventDateStart"></td>
      </tr>
      <tr>
        <td><strong>EVENT END</strong></td>
        <td><input type="datetime-local" id="staticStaffNo" name="txtSchoolEventDateEnd"></td>
      </tr>
        <td height="27" colspan="2"><div align="right"> 
            <button type="submit" class="btn btn-secondary" name="AddNews">Confirm</button>
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</form>