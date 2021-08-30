function autoHeight() {
  document.getElementById("footer").style.display = "block";
 $('#content').css('min-height', 0);
 $('#content').css('min-height', (
   $(document).height() 
   - $('#header').height() 
   - $('#footer').height()
   - ($('#content').outerHeight(true)- $('#content').outerHeight())
   ));
 }

 // onDocumentReady function bind
 $(document).ready(function() {
   autoHeight();
 });

 // onResize bind of the function
 $(window).resize(function() {
   autoHeight();
 });