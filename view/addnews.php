<form action="/ecommstudent/AnnouncementServlet?action=STUDENT" method="post" name="RTEDemo">

<script language="JavaScript" type="text/javascript">
	function submitForm() {
		if (document.RTEDemo.kategori.value=='') {
		  	alert("Please Select The Announcement category");
			return false;
		}
		return true;	  
	}
</script>
<script language="JavaScript">
 
$(document).ready(function(){
	$('.bottom').hide();


	$('.top').on('click', function() {
		$parent_box = $(this).closest('.box');
		$parent_box.siblings().find('.bottom').hide();
		$parent_box.find('.bottom').toggle();
	}); 
	
	$('#tajuk').keyup(function()
	{
		var yourInput = $(this).val();
		re = /[`~!@#$%^*|+\=?;:'"<>\{\}\[\]\\\/]/gi;
		var isSplChar = re.test(yourInput);
		if(isSplChar)
		{
			var no_spl_char = yourInput.replace(/[`~!@#$%^*|+\=?;:'"<>\{\}\[\]\\\/]/gi, '');
			$(this).val(no_spl_char);
		}
	});
 
});
</script>


<table width="100%" cellspacing="1" class="contentBgColorAlternate">
  <tbody><tr> 
    <td class="contentBgColor" width="590" height="20"><div align="right"></div></td>
    <td class="contentBgColor" width="47"> <div align="center">
    	<a href="announcement.jsp" onmouseover="window.status='Add Record';return true;"><strong>Main</strong></a></div></td>
    <td class="contentBgColor" width="10"><div align="center">|</div></td>
    <td class="contentBgColor" width="27"><div align="center">
    	<a href="announcement.jsp?action=add" onmouseover="window.status='Add Record';return true;"><strong>Add</strong></a></div></td>
    <td class="contentBgColor" width="10"><div align="center">|</div></td>
    <td class="contentBgColor" width="27"><div align="center">
    	<a href="announcement.jsp?action=search" onmouseover="window.status='Search Record';return true;"><strong>Search</strong></a></div></td>    	
    
    <td class="contentBgColor" width="10"><div align="center">| </div></td>
    <td class="contentBgColor" width="60" height="20"> <div align="center"><a href="announcement.jsp?action=archive" onmouseover="window.status='Archive Record';return true;"><strong>Archive</strong></a></div></td>
    <td class="contentBgColor" width="11"><div align="center">| </div></td>
    
</tr></tbody></table>



<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#D4D0C8" bgcolor="#FFFFCC">
	<tbody><tr> 
    	<td colspan="9" bgcolor="#FF9900"><font style="font-family: Arial; font-size: 11px;"><strong>Add record </strong></font></td>
    </tr>
    <tr> 
      	<td height="27"><strong><font style="font-family: Arial; font-size: 11px;">Category</font></strong></td>
      	<td><span style="font-family: Arial; font-size: 10px;"><b><font face="Geneva, Arial, Helvetica, san-serif"> 
        
        			<select name="kategori" class="smallfont" id="sid" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;" onchange="document.RTEDemo.action=&quot;announcement.jsp?action=add&quot;;document.RTEDemo.submit();">
          				<option value="">-Select Category-</option>
          
          <option value="9"> 
          Circular/Garis Panduan</option>
          
          <option value="5"> 
          Academic</option>
          
          <option value="6"> 
          Application System/Network/Server</option>
          
          <option value="7"> 
          Student Activity</option>
          
          <option value="1"> 
          Birth/Wedding/Death</option>
          
          <option value="2"> 
          Promotion</option>
          
          <option value="3"> 
          Lost and found</option>
          
          <option value="4"> 
          Others (Exclude Product Or Services Promotion)</option>
          
          <option value="8"> 
          Training</option>
          
          <option value="10"> 
          Entrepreneurship</option>
          
          <option value="11"> 
          Health Lifestyle Campaign</option>
          
          <option value="12"> 
          Announcement</option>
          
        </select>
        </font></b><b><font face="Geneva, Arial, Helvetica, san-serif"> 
        
        <input name="staff" type="hidden" id="staff" value="FB17024">
        <input name="addSeq" type="hidden" id="addSeq" value="729090">
        </font></b> </span></td>
    </tr>
</tbody></table>

<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#D4D0C8" bgcolor="#FFFFFF">
    <tbody><tr> 
      <td height="27"><strong><font style="font-family: Arial; font-size: 11px;">Title</font></strong></td>
      <td>
      <input name="tajuk" type="text" id="tajuk" size="50" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;" onkeyup="escapeHTML();"></td>
    </tr>
    <tr> 
      <td colspan="2"><strong><font style="font-family: Arial; font-size: 11px;">Message</font></strong><br><br>
      <textarea id="basic-example"></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'mesej' , { toolbar : 'umpLite' });
			</script>
			
      </td>
    </tr>
    <tr> 
      <td height="27"><strong><font style="font-family: Arial; font-size: 11px;">URL 
        reference </font></strong></td>
      <td><input name="url" type="text" id="url" value="http://" size="50" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;"></td>
    </tr>
    <tr> 
      <td height="27"><strong><font style="font-family: Arial; font-size: 11px;">Access 
        Type</font></strong></td>
      <td><table width="100%" border="0" cellspacing="0">
          <!--tr> 
            <td width="5%"><input type="radio" name="access" value="STAFF"></td>
            <td width="95%"><font style="font-family: Arial; font-size: 11px;">Staff</font></td>
          </tr-->
          <tbody><tr> 
            <td width="5%"><input type="radio" name="access" value="STUDENT" checked=""></td>
            <td width="95%"><font style="font-family: Arial; font-size: 11px;">Student</font></td>
          </tr>
        </tbody></table></td>
    </tr>
    <tr> 
      <td height="27" style="font-family: Arial; font-size: 11px;"><strong>Category</strong></td>
      <td><table width="100%" border="0" cellspacing="0">
          <tbody><tr> 
            <td width="5%"><input name="official" type="radio" value="Y"></td>
            <td width="95%"><font style="font-family: Arial; font-size: 11px;">Official</font></td>
          </tr>
          <tr> 
            <td><input name="official" type="radio" value="N" checked=""></td>
            <td><font style="font-family: Arial; font-size: 11px;">Unofficial</font></td>
          </tr>
		  
        </tbody></table></td>
    </tr>
    <tr> 
      <td height="27"><strong><font style="font-family: Arial; font-size: 11px;">Announcement 
        View </font></strong></td>
      <td><span style="font-family: Arial; font-size: 10px;"><b><font face="Geneva, Arial, Helvetica, san-serif"> 
        <select name="day" class="smallfont" id="day" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;">
          <option value="1">1 Day</option>
          <option value="2">2 Days</option>
          <option value="3">3 Days</option>
          <option value="4">4 Days</option>
          <option value="5">5 Days</option>
        </select>
        </font></b></span></td>
    </tr>
    <tr> 
      <td height="27" colspan="2"><div align="right"> 
          <input type="submit" name="Submit" value="Save" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;  font-weight: bold" onclick="return submitForm()">
          <input name="reset" type="reset" style="font-family: Verdana, sans-serif; font-size: 11px;  8px;  font-weight: bold" value="Reset">
        </div></td>
    </tr>
  </tbody></table>

    </form>

