// Awards section
$(document).on('click','#btnAddNewAward',function(e) {
  e.preventDefault();
    var data = $("#newaward").serialize();
  if ($('#newaward')[0].checkValidity() === false) {
      event.stopPropagation();
  } else {
       $.ajax({
              data: data,
              type: "post",
              url: "create",
              success: function(data){
                document.getElementById('positiveAlert').classList.remove('hidden');
                document.getElementById('positiveAlert').classList.add('showMe', 'animated', 'pulse');
              }

     });
  }
  $('#newaward').addClass('was-validated');

 });

$('#tableAwards').on('click', '.clickable-row', function(event) {
  // if ($(this).attr('class').includes('activerow')) {
 
    if ($(this).hasClass('activerow')) {
    $(this).removeClass('activerow');
  }
  else{
  $(this).addClass('activerow').siblings().removeClass('activerow');
  }
});

function DeleteAwardSelection(){
      var id = null;
      var exists = null;
      exists =document.getElementsByClassName('activerow');
      if ($(".activerow")[0]){
      $(".activerow").each(function() {
        if($(this).text().length > 0) {
           id = $(this).find('td').eq(0).text();
          /* alert("value: " + $(this).find('td').eq(0).text());*/
         }
      if (id != "") {

        $('#confirmDelete').modal('show');
      }else{
        alert("Oznacte najprv psa z tabulky stlacenim.");
      }
    });
    }
    else{
       alert("Oznacte najprv psa z tabulky stlacenim.");
    }  
  }



  function DeleteAward(){
    var id = null;
    var exists = null;
    exists =document.getElementsByClassName('activerow');
    if ($(".activerow")[0]){
    $(".activerow").each(function() {
      if($(this).text().length > 0) {
         id = $(this).find('td').eq(0).text();
        /* alert("value: " + $(this).find('td').eq(0).text());*/
       }
    if (id != "") {
      
        $.ajax({
               data: {
                 dogId:id
               },
               type: "post",
               url: "../../Includes/awards/delete.php",
               success: function(data){
                  location.reload();
               }

      });
    }else{
      alert("Oznacte najprv psa z tabulky stlacenim.");
    }
  });
  }
  else{
     alert("Oznacte najprv psa z tabulky stlacenim.");
  }
  }

// Dogs section
$(document).on('click','#btnAddNewDog',function(e) {
  e.preventDefault();
    var data = $("#newdog").serialize();
  if ($('#newdog')[0].checkValidity() === false) {
      event.stopPropagation();
  } else {
       $.ajax({
              data: data,
              type: "post",
              url: "../../Includes/dogs/create.php",
              success: function(data){
                  document.getElementById('positiveAlert').classList.remove('hidden');
                  document.getElementById('positiveAlert').classList.add('showMe', 'animated', 'pulse');
              }

     });
  }
  $('#newdog').addClass('was-validated');
 });



 $(document).on('click','#btnUpdateNewDog',function(e) {
 e.preventDefault();
   var data = $("#Updatedog").serialize();
 if ($('#Updatedog')[0].checkValidity() === false) {
     event.stopPropagation();
 } else {

      $.ajax({
             data: data,
             type: "post",
             url: "../../Includes/dogs/update.php",
             success: function(data){
                 document.getElementById('positiveAlert').classList.remove('hidden');
                 document.getElementById('positiveAlert').classList.add('showMe', 'animated', 'pulse');
             }

    });
 }
 $('#Updatedog').addClass('was-validated');
});

 function DeleteDogSelection(){
    var id = null;
    var exists = null;
    exists =document.getElementsByClassName('activerow');
    if ($(".activerow")[0]){
    $(".activerow").each(function() {
      if($(this).text().length > 0) {
         id = $(this).find('td').eq(0).text();
        /* alert("value: " + $(this).find('td').eq(0).text());*/
       }
    if (id != "") {

      $('#confirmDelete').modal('show');
    }else{
      alert("Oznacte najprv psa z tabulky stlacenim.");
    }
  });
  }
  else{
     alert("Oznacte najprv psa z tabulky stlacenim.");
  }  
 }



 $(document).on('click','#registerNewUser',function(e) {
  e.preventDefault();
    var data = $("#registerNewUserForm").serialize();
     
  if ($('#registerNewUserForm')[0].checkValidity() === false) {
      event.stopPropagation();
      console.log(data);
  } else {
       $.ajax({
              data: data,
              type: "post",
              url: "../../Includes/register.php",
              success: function(data){
                  document.getElementById('resultNewUserReg').classList.add("fadeInLeft");
                   document.getElementById('resultNewUserReg').innerHTML = "uspech";
              }

     });
  }
  $('#registerNewUser').addClass('was-validated');
 
 });

 $('#tableDogs').on('click', '.clickable-row', function(event) {
   // if ($(this).attr('class').includes('activerow')) {
  
    if ($(this).hasClass('activerow')) {
     $(this).removeClass('activerow');
   }
   else{
   $(this).addClass('activerow').siblings().removeClass('activerow');
   }
 });

// $('#tableDogs').on('click', '.clickable-row', function(event) {
//   $(this).addClass('active').siblings().removeClass('active');
// });



  function isIE() {
  ua = navigator.userAgent;
  /* MSIE used to detect old browsers and Trident used to newer ones*/
  var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
  
  return is_ie; 
}

$(document).on('click','#contactUs',function(e) {
 e.preventDefault();
   var data = $("#contactform").serialize();
    
 if ($('#contactform')[0].checkValidity() === false) {
     event.stopPropagation();
 } else {
      $.ajax({
             data: data,
             type: "post",
             url: "sendMail",
             success: function(data){
                  document.getElementById('resultContactUs').classList.add("heartBeat");
                  document.getElementById('resultContactUs').innerHTML = "Ďakujeme za Vašu správu, čoskoro sa Vám ozveme.";
             }

    });
 }
 $('#contactform').addClass('was-validated');

});



 $('#Card1').hover(
       function(){ $(this).addClass('pulse');$(this).removeClass('fadeInLeft') },
       function(){ $(this).removeClass('pulse') }
)
$('#Card2').hover(
       function(){ $(this).addClass('pulse');$(this).removeClass('fadeInDown') },
       function(){ $(this).removeClass('pulse') }
)
$('#Card3').hover(
       function(){ $(this).addClass('pulse');$(this).removeClass('fadeInRight') },
       function(){ $(this).removeClass('pulse') }
);


(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function hideMe(){
  getCookie("approval");
  setCookie("approval","True",30);
  $('#coockiemarker').fadeOut();
  
}



function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
      console.log(c.substring(name.length, c.length));
    }
  }
  return "";
}

function onInput() {
var val = document.getElementById("searchMembers").value;
    var opts = document.getElementById('resultSearch').childNodes;
    for (var i = 0; i < opts.length; i++) {
      if (opts[i].value === val) {
        // An item was selected from the list!
        // yourCallbackHere()
        window.location.href = 'http://' + opts[i].dataset.value;
        break;
      }
    }
}

 $(document).on('click','#btnUpdateProfile',function(e) {
 e.preventDefault();
   var data = $("#updateProfile").serialize();
 if ($('#updateProfile')[0].checkValidity() === false) {
     event.stopPropagation();
 } else {

      $.ajax({
             data: data,
             type: "post",
             processData: false,  // tell jQuery not to process the data
       contentType: false, 
             url: "../../Includes/myprofile/update.php",
             success: function(data){
                 document.getElementById('positiveAlert').classList.remove('hidden');
                 document.getElementById('positiveAlert').classList.add('showMe', 'animated', 'pulse');
             }

    });
 }
 $('#updateProfile').addClass('was-validated');
});

 