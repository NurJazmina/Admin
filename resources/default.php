<?php
if (isset($_GET['page']) && !empty($_GET['page'])) 
{
    if ($_GET['page']=="departmentlist")
    {
      ?>
      <script>
      var AddDepartmentModal = document.getElementById('AddDepartmentModal')
      AddDepartmentModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = AddDepartmentModal.querySelector('.modal-title')
      var modalBodyInput = AddDepartmentModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      }) 

      var EditDepartmentModal = document.getElementById('EditDepartmentModal')
      EditDepartmentModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = EditDepartmentModal.querySelector('.modal-title')
      var modalBodyInput = EditDepartmentModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var DeleteDepartmentModal = document.getElementById('DeleteDepartmentModal')
      DeleteDepartmentModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = DeleteDepartmentModal.querySelector('.modal-title')
      var modalBodyInput = DeleteDepartmentModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="news") 
    {
      ?>
      <script>
      //Limit characters displayed in span
      $(document).ready(function(){
      $('.claimedRight').each(function (f) {
          var newstr = $(this).text().substring(0,100)+'....';
          $(this).text(newstr);

          });
      })
      </script>
      <?php
    }
    if ($_GET['page']=="subjectlist") 
    {
      ?>
      <script>
        var AddSubjectModal = document.getElementById('AddSubjectModal')
        AddSubjectModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = AddSubjectModal.querySelector('.modal-title')
        var modalBodyInput = AddSubjectModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var EditSubjectModal = document.getElementById('EditSubjectModal')
        EditSubjectModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = EditSubjectModal.querySelector('.modal-title')
        var modalBodyInput = EditSubjectModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var DeleteSubjectModal = document.getElementById('DeleteSubjectModal')
        DeleteSubjectModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = DeleteSubjectModal.querySelector('.modal-title')
        var modalBodyInput = DeleteSubjectModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="stafflist") 
    {
      ?>
      <script>
      var recheckaddstaff = document.getElementById('recheckaddstaff')
      recheckaddstaff.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = recheckaddstaff.querySelector('.modal-title')
      var modalBodyInput = recheckaddstaff.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var recheckeditstaff = document.getElementById('recheckeditstaff')
      recheckeditstaff.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = recheckeditstaff.querySelector('.modal-title')
      var modalBodyInput = recheckeditstaff.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var StatusStaffModal = document.getElementById('StatusStaffModal')
      StatusStaffModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = StatusStaffModal.querySelector('.modal-title')
      var modalBodyInput = StatusStaffModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      
    $(document).ready(function () {
        $("#staffattendance").table2excel({
            filename: "Staffattendance.xls"
        });
    });
      </script>
      <?php
    }
    if ($_GET['page']=="studentlist") 
    {
      ?>
      <script>
      var recheckaddstudent = document.getElementById('recheckaddstudent')
      recheckaddstudent.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = recheckaddstudent.querySelector('.modal-title')
      var modalBodyInput = recheckaddstudent.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var recheckeditstudent = document.getElementById('recheckeditstudent')
      recheckeditstudent.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = recheckeditstudent.querySelector('.modal-title')
      var modalBodyInput = recheckeditstudent.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var StatusStudentModal = document.getElementById('StatusStudentModal')
      StatusStudentModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = StatusStudentModal.querySelector('.modal-title')
      var modalBodyInput = StatusStudentModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="parentlist") 
    {
      ?>
      <script>
        var recheckaddparent = document.getElementById('recheckaddparent')
        recheckaddparent.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = recheckaddparent.querySelector('.modal-title')
        var modalBodyInput = recheckaddparent.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var RecheckEditParent = document.getElementById('RecheckEditParent')
        RecheckEditParent.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = RecheckEditParent.querySelector('.modal-title')
        var modalBodyInput = RecheckEditParent.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var StatusParentModal = document.getElementById('StatusParentModal')
        StatusParentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = StatusParentModal.querySelector('.modal-title')
        var modalBodyInput = StatusParentModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="classroomlist") 
    {
      ?>
      <script>
        var recheckaddclass = document.getElementById('recheckaddclass')
        recheckaddclass.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = recheckaddclass.querySelector('.modal-title')
        var modalBodyInput = recheckaddclass.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var recheckeditclass = document.getElementById('recheckeditclass')
        recheckeditclass.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = recheckeditclass.querySelector('.modal-title')
        var modalBodyInput = recheckeditclass.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var DeleteclassModal = document.getElementById('DeleteclassModal')
        DeleteclassModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = DeleteclassModal.querySelector('.modal-title')
        var modalBodyInput = DeleteclassModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="timetablelist") 
    {
      ?>
      <script>
      var recheckedittimetable = document.getElementById('recheckedittimetable')
      recheckedittimetable.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = recheckedittimetable.querySelector('.modal-title')

      var modalBodyInput = recheckedittimetable.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var StatusTimetableModal = document.getElementById('StatusTimetableModal')
      StatusTimetableModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = StatusTimetableModal.querySelector('.modal-title')
      var modalBodyInput = StatusTimetableModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="home") 
    {
      ?>
      <script>
      //Limit characters displayed in span
      $(document).ready(function(){
      $('.claimedRight').each(function (f) {
          var newstr = $(this).text().substring(0,100)+'....';
          $(this).text(newstr);

          });
      })
      </script>
      <?php
    }
    if ($_GET['page']=="aboutme") 
    {
      ?>
      <script>
      var EditDetailModal = document.getElementById('EditDetailModal')
      EditDetailModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = EditDetailModal.querySelector('.modal-title')
      var modalBodyInput = EditDetailModal.querySelector('.modal-body input')
      modalBodyInput.value = recipient})
      </script>
      <?php
    }
    if ($_GET['page']=="staffdetail") 
    {
      ?>
      <script>
      var UpdateStaffremark = document.getElementById('UpdateStaffremark')
      UpdateStaffremark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = UpdateStaffremark.querySelector('.modal-title')
      var modalBodyInput = UpdateStaffremark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="studentdetail") 
    {
      ?>
      <script>
      var Updatestudentremark = document.getElementById('Updatestudentremark')
      Updatestudentremark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = Updatestudentremark.querySelector('.modal-title')
      var modalBodyInput = Updatestudentremark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="parentdetail") 
    {
      ?>
      <script>
      var UpdateParentremark = document.getElementById('UpdateParentremark')
      UpdateParentremark.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = UpdateParentremark.querySelector('.modal-title')
        var modalBodyInput = UpdateParentremark.querySelector('.modal-body input')
        modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="departmentdetail") 
    {
      ?>
      <script>
      var Updatedepartmentremark = document.getElementById('Updatedepartmentremark')
      Updatedepartmentremark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = Updatedepartmentremark.querySelector('.modal-title')
      var modalBodyInput = Updatedepartmentremark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="classdetail") 
    {
      ?>
      <script>
      var UpdateClassremark = document.getElementById('UpdateClassremark')
      UpdateClassremark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = UpdateClassremark.querySelector('.modal-title')
      var modalBodyInput = UpdateClassremark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="subjectdetail") 
    {
      ?>
      <script>
      var Updatesubjectremark = document.getElementById('Updatesubjectremark')
      Updatesubjectremark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = Updatesubjectremark.querySelector('.modal-title')
      var modalBodyInput = Updatesubjectremark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="schoolforum") 
    {
      ?>
      <script>
      //Limit characters displayed in span
      $(document).ready(function(){
      $('.claimedRight').each(function (f) {
          var newstr = $(this).text().substring(0,200)+'....';
          $(this).text(newstr);

          });
      })
      </script>
      <?php
    }
    if ($_GET['page']=="publicforum") 
    {
      ?>
      <script>
      //Limit characters displayed in span
      $(document).ready(function(){
      $('.claimedRight').each(function (f) {
          var newstr = $(this).text().substring(0,100)+'....';
          $(this).text(newstr);

          });
      })
      </script>
      <?php
    }
    if ($_GET['page']=="change-password") 
    {
      ?>
      <script>
      var check = function() {
        if (document.getElementById('password').value ==
          document.getElementById('confirm_password').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'matching';
        } else {
          document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'not matching';
        }
      }
      </script>
      <?php
      }
      if ($_GET['page']=="schoolforumdetail") 
      {
        ?>
        <script>
        //Limit characters displayed in span
        $(document).ready(function(){
        $('.claimedRight').each(function (f) {
            var newstr = $(this).text().substring(0,100)+'....';
            $(this).text(newstr);

            });
        })
        </script>
        <?php
      }
      if ($_GET['page']=="publicforumdetail") 
      {
        ?>
        <script>
        //Limit characters displayed in span
        $(document).ready(function(){
        $('.claimedRight').each(function (f) {
            var newstr = $(this).text().substring(0,100)+'....';
            $(this).text(newstr);

            });
        })
        </script>
        <?php
      }
      if ($_GET['page']=="subject") 
      {
        ?>
          <script>
          $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
          })
          </script>
          <?php
      }
      if ($_GET['page']=="ol_quiz") 
      {
      ?>
      <script>
      </script>
      <?php
      }
}
?>

