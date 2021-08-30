<?php
  if (isset($_GET['login']) && $_GET['login'] != 'success') {
    echo"<script type='text/javascript'>
    var element = document.getElementById('modalLRForm');
    element.classList.remove('fade');
    $(window).on('load',function(){
    $('#modalLRForm').modal('show');
    });
    </script>";
    switch ($_GET['login']) {
      case 'pwerror':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Nesprávny email alebo heslo!</p>
        </div>";
        break;
      case 'emptyerror':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Vložte email aj heslo!</p>
        </div>";
        break;
      case 'sqlerror':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Ospravedlňujeme sa, ale nastal problem so serverom.</p>
        </div>";
        break;
      case 'incorrectmail':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Nesprávny email alebo heslo, alebo účet este nebol aktivovaný!</p>
        </div>";
        break;
      case 'locked':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Účet bol z bezpečnostých dôvodov zablokovaný. Prosíme Vás o resetovanie hesla!</p>
        </div>";
        break;
      case 'success':
        include('loginActions.php');
        break;
      default:
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Nastala chyba!</p>
        </div>";
        break;
    }

  }
?>