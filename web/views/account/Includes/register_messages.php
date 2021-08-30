<?php
  if (isset($_GET['signup']) && $_GET['signup'] != 'success') {
    echo"<script type='text/javascript'>
    var element = document.getElementById('modalLRForm');
    element.classList.remove('fade');
    document.getElementById('login').classList.remove('active');
    document.getElementById('registration').classList.add('active');
    document.getElementById('loginTab').classList.remove('active','show');
    document.getElementById('registerTab').classList.add('active','show');
    $(window).on('load',function(){
    $('#modalLRForm').modal('show');
    });
    </script>";
    switch ($_GET['signup']) {
      case 'empty':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Vyplnte povinné polia!</p>
        </div>";
        break;
      case 'passworddifferent':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Heslá sa nezhodujú!</p>
        </div>";
        break;
      case 'email':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Zadajte emailovú adresu spravne.</p>
        </div>";
        break;
      case 'sqlerror':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Ospravedlňujeme sa ale nastal problém so serverom.</p>
        </div>";
        break;
      case 'alredyexists':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:red;'>Zadaný email už bol kedysi použitý na registraciu.</p>
        </div>";
        break;
        case 'success':
        echo "<div class='col-md-10 offset-md-1 mt-2 text-center'>
        <p style='color:green;'>Na váš email vám bol odoslaný potvrdzovací email!</p>
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