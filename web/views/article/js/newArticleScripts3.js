$(document).ready(function() {
    $('#newTextEditor').summernote({
        height: "300px",
        lang:"sk-SK",
        callbacks: {
            onImageUpload: function(files,editor,welEditable) {
                uploadFile(files[0],this);
            }
        }
    });
});

function uploadFile(file,el) {
    data = new FormData();
    data.append("articlePhoto", file);

    $.ajax({
        data: data,
        type: "POST",
        url: "/article/uploadImage", //replace with your url
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          var root = "/views/article/img/";
          console.log(root + data);
            $(el).summernote("insertImage", root + data);
        }
    });
}

$(document).on('click','#submit',function(e) {
   content = $('#newTextEditor').summernote('code');
   var today = new Date();
   var dd = String(today.getDate()).padStart(2, '0');
   var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
   var yyyy = today.getFullYear();
   var title = document.getElementById('title').value;
   var shortDesc = document.getElementById('shortDescription').value;
   var category = document.getElementById('category').value;
   today = yyyy + '-' + mm + '-' + dd;
   console.log('here');
    $.ajax({
       data: {'content': content,
                'dateOfModification':today,
            'title':title,
            'category':category,
            'shortDesc':shortDesc
   }, 
       type: "post",
       url: "/article/insert",

       success: function(data){
        alert(title);
       }
      });
});