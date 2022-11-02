var fileobj;
function upload_file(e) {
  debugger;
  e.preventDefault();
  fileobj = e.dataTransfer.files[0];
  ajax_file_upload(fileobj);
}

function file_explorer() {
  debugger;
  document.getElementById('selectfile').click();
  document.getElementById('selectfile').onchange = function() {
    fileobj = document.getElementById('selectfile').files[0];
    ajax_file_upload(fileobj);
  };
}

function ajax_file_upload(file_obj) {
  debugger;
  if(file_obj != undefined) {
    var form_data = new FormData();
    form_data.append('file', file_obj);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax.php", true);
    xhttp.onload = function(event) {
      oOutput = document.querySelector('.img-content');
      if (xhttp.status == 200) {
        oOutput.innerHTML = "<img width='300px' height='150px' src='"+ this.responseText +"' alt='The Image' />";
        document.getElementById('uploaded_file').value = this.responseText;
      } else {
        oOutput.innerHTML = "Error " + xhttp.status + " occurred when trying to upload your file.";
      }
    }

    xhttp.send(form_data);
  }
}