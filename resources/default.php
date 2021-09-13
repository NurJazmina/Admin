<?php
if (isset($_GET['page']) && !empty($_GET['page'])) 
{
    if ($_GET['page']=="departmentlist")
    {
      ?>
      <script>
      var add_department = document.getElementById('add_department')
      add_department.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = add_department.querySelector('.modal-title')
      var modalBodyInput = add_department.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var edit_department = document.getElementById('edit_department')
      edit_department.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = edit_department.querySelector('.modal-title')
      var modalBodyInput = edit_department.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var delete_department = document.getElementById('delete_department')
      delete_department.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = delete_department.querySelector('.modal-title')
      var modalBodyInput = delete_department.querySelector('.modal-body input')
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
        var add_subject = document.getElementById('add_subject')
        add_subject.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = add_subject.querySelector('.modal-title')
        var modalBodyInput = add_subject.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var edit_subject = document.getElementById('edit_subject')
        edit_subject.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = edit_subject.querySelector('.modal-title')
        var modalBodyInput = edit_subject.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var delete_subject = document.getElementById('delete_subject')
        delete_subject.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = delete_subject.querySelector('.modal-title')
        var modalBodyInput = delete_subject.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="stafflist") 
    {
      ?>
      <script>
      var edit_staff = document.getElementById('edit_staff')
      edit_staff.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = edit_staff.querySelector('.modal-title')
      var modalBodyInput = edit_staff.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var status_staff = document.getElementById('status_staff')
      status_staff.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = status_staff.querySelector('.modal-title')
      var modalBodyInput = status_staff.querySelector('.modal-body input')
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
      var edit_student = document.getElementById('edit_student')
      edit_student.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = edit_student.querySelector('.modal-title')
      var modalBodyInput = edit_student.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var status_student = document.getElementById('status_student')
      status_student.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = status_student.querySelector('.modal-title')
      var modalBodyInput = status_student.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="parentlist") 
    {
      ?>
      <script>
        var status_parent = document.getElementById('status_parent')
        status_parent.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = status_parent.querySelector('.modal-title')
        var modalBodyInput = status_parent.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="classroomlist") 
    {
      ?>
      <script>
        var add_class = document.getElementById('add_class')
        add_class.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = add_class.querySelector('.modal-title')
        var modalBodyInput = add_class.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var edit_class = document.getElementById('edit_class')
        edit_class.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = edit_class.querySelector('.modal-title')
        var modalBodyInput = edit_class.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })

        var delete_class = document.getElementById('delete_class')
        delete_class.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = delete_class.querySelector('.modal-title')
        var modalBodyInput = delete_class.querySelector('.modal-body input')
        modalBodyInput.value = recipient
        })
      </script>
      <?php
    }
    if ($_GET['page']=="timetablelist") 
    {
      ?>
      <script>
      var edit_timetable = document.getElementById('edit_timetable')
      edit_timetable.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = edit_timetable.querySelector('.modal-title')

      var modalBodyInput = edit_timetable.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var delete_timetable = document.getElementById('delete_timetable')
      delete_timetable.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = delete_timetable.querySelector('.modal-title')
      var modalBodyInput = delete_timetable.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var status_timetable = document.getElementById('status_timetable')
      status_timetable.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = status_timetable.querySelector('.modal-title')
      var modalBodyInput = status_timetable.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="forumdetail") 
    {
      ?>
      <script>
      var edit_forum = document.getElementById('edit_forum')
      edit_forum.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = edit_forum.querySelector('.modal-title')
      var modalBodyInput = edit_forum.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })

      var delete_forum = document.getElementById('delete_forum')
      delete_forum.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = delete_forum.querySelector('.modal-title')
      var modalBodyInput = delete_forum.querySelector('.modal-body input')
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
      var update_staff_remark = document.getElementById('update_staff_remark')
      update_staff_remark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_staff_remark.querySelector('.modal-title')
      var modalBodyInput = update_staff_remark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="studentdetail") 
    {
      ?>
      <script>
      var update_student_remark = document.getElementById('update_student_remark')
      update_student_remark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_student_remark.querySelector('.modal-title')
      var modalBodyInput = update_student_remark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="parentdetail") 
    {
      ?>
      <script>
      var update_parent_remark = document.getElementById('update_parent_remark')
      update_parent_remark.addEventListener('show.bs.modal', function(event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_parent_remark.querySelector('.modal-title')
      var modalBodyInput = update_parent_remark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="departmentdetail") 
    {
      ?>
      <script>
      var update_department_remark = document.getElementById('update_department_remark')
      update_department_remark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_department_remark.querySelector('.modal-title')
      var modalBodyInput = update_department_remark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="classdetail") 
    {
      ?>
      <script>
      var update_class_remark = document.getElementById('update_class_remark')
      update_class_remark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_class_remark.querySelector('.modal-title')
      var modalBodyInput = update_class_remark.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
    }
    if ($_GET['page']=="subjectdetail") 
    {
      ?>
      <script>
      var update_subject_remark = document.getElementById('update_subject_remark')
      update_subject_remark.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = update_subject_remark.querySelector('.modal-title')
      var modalBodyInput = update_subject_remark.querySelector('.modal-body input')
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
      if ($_GET['page']=="ol_subject") 
      {
        ?>
          <script>
          var topic = document.getElementById('topic')
          topic.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          var button = event.relatedTarget
          // Extract info from data-bs-* attributes
          var recipient = button.getAttribute('data-bs-whatever')
          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          //
          // Update the modal's content.
          var modalTitle = topic.querySelector('.modal-title')
          var modalBodyInput = topic.querySelector('.modal-body input')
          modalBodyInput.value = recipient
          })
          </script>
          <?php
      }
      if ($_GET['page']=="ol_notes") 
      {
        ?>
          <script>
          var activity = document.getElementById('activity')
          activity.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          var button = event.relatedTarget
          // Extract info from data-bs-* attributes
          var recipient = button.getAttribute('data-bs-whatever')
          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          // Update the modal's content.
          var modalTitle = activity.querySelector('.modal-title')
          var modalBodyInput = activity.querySelector('.modal-body input')
          modalBodyInput.value = recipient
          })

          var edit = document.getElementById('edit')
          edit.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          var button = event.relatedTarget
          // Extract info from data-bs-* attributes
          var recipient = button.getAttribute('data-bs-whatever')
          // If necessary, you could initiate an AJAX request here
          // and then do the updating in a callback.
          // Update the modal's content.
          var modalTitle = edit.querySelector('.modal-title')
          var modalBodyInput = edit.querySelector('.modal-body input')
          modalBodyInput.value = recipient
          })
          </script>
          <?php
      }
      if ($_GET['page']=="ol_submit_assignment") 
      {
      ?>
      <script>
      var EditGrade = document.getElementById('EditGrade')
      EditGrade.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = EditGrade.querySelector('.modal-title')
      var modalBodyInput = EditGrade.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
      }
      if ($_GET['page']=="ol_submit_quiz") 
      {
      ?>
      <script>
      var EditCommentQuiz = document.getElementById('EditCommentQuiz')
      EditCommentQuiz.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = EditCommentQuiz.querySelector('.modal-title')
      var modalBodyInput = EditCommentQuiz.querySelector('.modal-body input')
      modalBodyInput.value = recipient
      })
      </script>
      <?php
      }
}
?>

