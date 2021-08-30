<?php
  if(isset($_SESSION['u_email'])) {
    ?>

        <form class=" my-2 my-md-0">
          <input class="form-control mr-sm-2" type="search" oninput='onInput2()' placeholder="Hladat ludi" aria-label="Search" name="searchMembers2" id="searchMembers2" list="resultSearch2" autocomplete="off">
          <datalist id="resultSearch2">
           </datalist>
        </form>
        <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Moje menu
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?="//" .URL. 'dashboard';?>">Moja hlavna stranka</a>
          <a class="dropdown-item" href="<?="//" .URL. 'profile/index/' .$_SESSION['u_id'];?>">Moj profil</a>
          <a class="dropdown-item" href="<?="//" .URL. 'dogs/mydogs'?>">Moje Psy</a>
          <a class="dropdown-item" href="<?="//" .URL. 'awards/myawards';?>">Moje ocenenia</a>
          <a class="dropdown-item" href="<?="//" .URL. '/pages/members/menu.php';?>">Moje statistiky</a>
          <div class="dropdown-divider"></div>
          <form action="<?="//" .URL. 'account/logout';?>" method="post" class="mr-5" style="margin-bottom:0px!important;">
            <a class="dropdown-item" href="<?="//" .URL. 'account/logout';?>">Logout</a>
          </form>
        </div>

      </li>

      <script>

</script>
      <?php
  }
  else{
    ?>
        <li class="nav-item">
          <a class="nav-link" href="nav-link" href="#" data-toggle="modal" data-target="#modalLRForm">Prihlásiť</a>
        </li>
    <?php 
  }
?>
    <script>

        $(document).ready(function(){
        $('#searchMembers2').keyup(function(){
            var txt =$(this).val();
            if (txt == '') {
                 console.log("here");
            }else{
              $('#resultSearch2').html('');
              $.ajax({
                url: "/dashboard/search",
                method: "post",
                data: {searchMembers:txt},
                dataType:"text",
                success:function(data)
                {
                   $('#resultSearch2').html(data);
                }
              })
            }
        });
      });

      function onInput2() {
      var val = document.getElementById("searchMembers2").value;
          var opts = document.getElementById('resultSearch2').childNodes;
          //console.log(opts[0].value);
          for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
              // An item was selected from the list!
              // yourCallbackHere()
              window.location.href = 'http://' + opts[i].dataset.value;
              break;
            }
          }
      }
    </script>