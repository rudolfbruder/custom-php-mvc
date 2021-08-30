<?php
  if (isset($_GET['reset'])) {
    echo"<script type='text/javascript'>
    var element = document.getElementById('modalLRForm');
    element.classList.remove('fade');
    document.getElementById('login').classList.remove('active');
    document.getElementById('pwdReset').classList.add('active');
    document.getElementById('loginTab').classList.remove('active','show');
    document.getElementById('pwdResetTab').classList.add('active','show');
    $(window).on('load',function(){
    $('#modalLRForm').modal('show');
    });
    </script>";
    switch ($_GET['reset']) {
      case 'notfound':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Účet so zadaným emailom neexistuje!</p>
        </div>";
        break;
        case 'success':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:green;'>Na váš email vám bol odoslaný link ktorým si zresetujete heslo. Link je platný po dobu 15 minút.</p>
        </div>";
        break;
        case 'successreset':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:green;'>Vaše heslo bolo úspešne zmenené. Môžete sa prihlásiť.</p>
        </div>";
        break;
      default:
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Prepáčte ale nastala chyba. Ak chyba pretrváva kontaktujte ná.</p>
        </div>";
        break;
    }
  }
?>