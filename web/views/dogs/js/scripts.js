function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#profileImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#profilePhoto").change(function(){
    readURL(this);
});

//no more ajax query for creating new dog
// $(document).on('click','#btnAddNewDog2',function(e) {
//   e.preventDefault();
//   var form = document.getElementById('newdog');
//   var form_data = new FormData($(form)[0]);
// //	    var data = $("#newdog").serialize();
// console.log.form_data;
//   if ($('#newdog')[0].checkValidity() === false) {
//       event.stopPropagation();
//   } else {
//        $.ajax({
//               data: form_data,
//               type: "post",
//               url: "createDog",
//               contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
//                   processData: false, // NEEDED, DON'T OMIT THIS
//               success: function(data){
//                 window.location.href ="http://www.dogchamp.sk/dogs/success/" 
//               }

//      });
//   }
//   $('#newdog').addClass('was-validated');
//  });


