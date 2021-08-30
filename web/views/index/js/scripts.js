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
	    }
	  }
	  return "";
	}

function hideMe(){
  setCookie("approval","True",30);
  $('#coockiemarker').fadeOut();
  
}

$(document).ready(function(){
  	 	var checkApproval =  getCookie("approval");
  	 	if (checkApproval != "True") {
  	 		  setCookie("approval","True",30);
  	 		  $('#coockiemarker').fadeIn();
  		}
});

$(document).on('click','#contactUs2',function(e) {
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