<?php
    require_once 'config/config.php';
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>  
    <title>DogChamp(alpha)</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--     <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="<?="//" .URL. 'public/css/MyStyles.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.7/bootstrap-confirmation.js"></script>
    <script src="<?="//" .URL. 'public/js/bootstrap-select.min.js';?>"></script>
    <script src="https://kit.fontawesome.com/46b2db2654.js"></script>   

  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-light bg-light" id="header">
      <a class="navbar-brand" href="<?="//" .URL;?>">DogChamp<small>(alpha)</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?="//" .URL. 'index';?>">Úvod</a>
          </li>
         <li class="nav-item">
            <a class="nav-link " href="<?="//" .URL. 'index/about';?>">Čo je to DogChamp?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?="//" .URL. 'index/aboutus';?>">O nás</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?="//" .URL. 'index/contact';?>" >Kontakt</a>
          </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">	
        <?php  include('views/account/Includes/login_actions.php')?>

        </ul>
      </div>
    </nav>
	<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <!-- Modal tabs -->
      <div class="modal-c-tabs">
        <ul class="nav nav-tabs md-tabs tabs-2 darken-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active loginLink" data-toggle="tab" href="#loginTab" role="tab" id="login">
              Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link loginLink" data-toggle="tab" href="#registerTab" role="tab" id="registration">
              Registrácia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link loginLink" data-toggle="tab" href="#pwdResetTab" role="tab" id="pwdReset">
              Zabudnuté heslo</a>
          </li>
        </ul>
        <!-- Tab panels -->
        <div class="tab-content">
          <!--Panel Login-->
          <div class="tab-pane fade in show active" role="tabpanel" id="loginTab">
            <form <?php echo "action=/account/login"?> method="post" class="needs-validation"novalidate>         
      				<?php include('views/account/Includes/login_messages.php');?>
              <div class="col-md-10 offset-md-1 mb-3 mt-1 ">
                <label  for="emailLogin">Váš email</label>
                <input type="email" name="emailLogin" class="form-control" id="emailLogin" placeholder="Email" required>
                  <div class="invalid-tooltip">
                    Zadajte email.
                  </div>
              </div>
              <div class="col-md-10 offset-md-1 mb-3">
                <label for="passwordLogin">Vaše heslo</label>
                <input type="password" name="passwordLogin" class="form-control" id="passwordLogin" placeholder="Heslo" autocomplete="off" required>
                  <div class="invalid-tooltip">
                    Zadajte heslo.
                  </div>
              </div>
              <div class="text-center mt-2">
                <a <?php echo "href=/account/login"?>><button type="submit" name="submit" class="btn btn-success">Prihlásiť sa</button></a>
              </div>
            </form>
          </div>
          <!--Panel Registration-->
          <div class="tab-pane fade" role="tabpanel" id="registerTab">
            <form action="/account/register" method="post" class="needs-validation"novalidate>
              <?php include('views/account/Includes/register_messages.php');?>
                <div class="col-md-10 offset-md-1 mb-3 mt-2">
                  <label for="firstName">Vložte krstné meno</label>
                  <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Krstne meno" required>
                    <div class="invalid-tooltip">
                      Zadajte krstné meno.
                    </div>
                </div>
                <div class="col-md-10 offset-md-1 mb-3">
                  <label for="lastName">Vložte priezvisko</label>
                  <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Priezvisko" required>
                    <div class="invalid-tooltip">
                      Zadajte priezvisko.
                    </div>
                </div>
                <div class="col-md-10 offset-md-1 mb-3">
                  <label for="emailReg">Vložte váš email</label>
                  <input type="email" name="emailReg" class="form-control" id="emailReg" placeholder="Email" required>
                    <div class="invalid-tooltip">
                      Zadajte váš email.
                    </div>
                </div>
                <div class="col-md-10 offset-md-1 mb-3">
                  <label for="passwordReg">Vaše nové heslo</label>
                  <input type="password" name="passwordReg" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="passwordReg" placeholder="Heslo" autocomplete="off"  required>
                    <div class="invalid-tooltip">
                      Zadajte heslo.
                    </div>
                </div>
                <div class="col-md-10 offset-md-1 mb-3">
                  <label for="passwordVerif">Vaše nové heslo znova</label>
                  <input type="password" name="passwordVerif" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="passwordVerif" placeholder="Heslo znova" autocomplete="off" required>
                    <div class="invalid-tooltip">
                      Zadajte heslo znova.
                    </div>
                </div>
              <div class="text-center form-sm mt-2">
                <a href="/account/register"><button type="submit" name="submit" class="btn btn-success">Registrovať</button></a>
              </div>            
            </form>
          </div>
          <!--/.Panel Password reset-->
          <div class="tab-pane fade" id="pwdResetTab" role="tabpanel">
            <form action="/account/passwordreset" method="post" class="needs-validation"novalidate>
              <?php include('views/account/Includes/password_reset_messages.php');?>
                <div class="col-md-10 offset-md-1 mb-3 mt-1">
                  <label for="emailNewPw">Váš email</label>
                  <input type="email" name="emailNewPw" class="form-control" id="emailNewPw" placeholder="Email" required>
                    <div class="invalid-tooltip">
                      Zadajte email.
                    </div>
                </div>
                <div class="text-center form-sm mt-1">
                  <a href="/account/passwordreset"><button type="submit" name="submit" class="btn btn-success">Poslať nové heslo</button></a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
