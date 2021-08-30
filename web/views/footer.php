    <script src="<?="//" .URL. 'public/js/MyScripts.js';?>"></script>
    <div class="container" id="footer">
      <hr>
      <div class="row">
        <div class="col-lg-4">
          <span style="font-size: 3em; color: #4267b2;">
            <i class="fab fa-facebook-f"></i>
          </span>
          <span style="font-size: 3em; color: #4267b2;">
            <i class="fab fa-twitter-square"></i>
          </span>
          <span style="font-size: 3em; color: red;">
            <i class="fab fa-youtube-square"></i>
          </span>
         
        </div>
        <div class="col-lg-4">
          <div class="text-center">
            <?php
              if(isset($_SESSION['u_email'])) {
              }
              else{
                ?>
                <h6>Stante sa členom zdarma!</h6>
                <a data-toggle='modal' data-target='#modalLRForm'><button class='btn btn-success' style='border-radius: 12px;'>Registrujte tu</button> </a>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="col-lg-1">
        </div>
        <div class="col-lg-3">
          <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Novinky</a></li>
              <li><a class="text-muted" href="#">Všeobecné podmienky</li>
              <li><a class="text-muted" href="#">Kontaktujte nás</a></li>
              <li><a class="text-muted" href="#">F.A.Q</a></li>
              <li><a class="text-muted" href="#">Spät hore</a></li>
            </ul>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="<?="//" .URL. 'public/js/footer.js';?>"></script>  


