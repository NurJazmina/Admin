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


/*home.php--start*/
var EditSchoolModal = document.getElementById('EditSchoolModal')
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
