/*tinyMCE for addnews--start*/
tinymce.init({
  selector: 'textarea#basic-example',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
/*tinyMCE for addnews*/

/*aboutme.php--start*/
//edit detail view/aboutme
var EditDetailModal = document.getElementById('#EditDetailModal')
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
/*aboutme.php--end*/

/*home.php--start*/
var EditSchoolModal = document.getElementById('#EditSchoolModal')
EditSchoolModal.addEventListener('show.bs.modal', function (event) {
// Button that triggered the modal
var button = event.relatedTarget
// Extract info from data-bs-* attributes
var recipient = button.getAttribute('data-bs-whatever')
// If necessary, you could initiate an AJAX request here
// and then do the updating in a callback.
//
// Update the modal's content.
var modalTitle = EditSchoolModal.querySelector('.modal-title')
var modalBodyInput = EditSchoolModal.querySelector('.modal-body input')
modalBodyInput.value = recipient})
/*home.php--end*/

/*departmentlist.php--start*/
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
/*departmentlist.php--end*/