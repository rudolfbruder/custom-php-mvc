<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<link href="<?="//" .URL. 'views/article/css/styles.css';?>" rel="stylesheet">
<body class="d-none" id="body">
  <div class="container" id="content">
    <div class="row mt-5">
      <div class="col-md-10 offset-md-1">
        <div class="text-center">
         <h4>Váš nový príspevok</h4>
        </div>
      <form action="createPreview" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div class="form-row my-3">
          <div class="col-md-3 mt-5 text-center">
              <img src="<?="//" .URL. '/views/article/img/articleDefault.png';?>" id="articlePhotoMain" class="img-fluid mb-2" style="max-height: 120.500px;" alt="profileImg2">
              <label for="titlePhoto" class="btn btn-success" id="profilePhotoLab">
              <input id="titlePhoto" name="titlePhoto"  type="file" style="display:none" 
                  onchange="$('#upload-file-info').html(this.files[0])">
              Pridat fotku</label>
              <span class='label label-info' id="upload-file-info" value=""></span>
          </div>
          <div class="col-md-9">
            <div class="col-md-12 p-0">
              <label for="title" id="titleLab">Názov článku:</label>
              <input type="text" class="form-control" placeholder="Vložte titulok článku" required name="title" id="title" required>
              <div class="invalid-tooltip">
                Zadajte názov článku!
              </div>
            </div>
              <div class="col-md-12 p-0">
              <label for="category" id="titleLab" for="title">Kategória:</label>
              <select  class="selectpicker form-control" title="Vyberte kategóriu"  data-show-subtext="true" data-live-search="true" id="category" name="category" required>
                  <option>Výstava</option>
                  <option>Váš pes</option>
                  <option>Iné</option>
              </select>
              <div class="invalid-tooltip" style="z-index: 2">
                Vyberte kategóriu!
              </div>
            </div>
              <div class="col-md-12 p-0">
              <label for="shortDescription">Krátky popis článku:</label>
              <textarea type="text" name="shortDescription" class="form-control shortTextArea" id="shortDescription" placeholder="Sprievodný text článku" required></textarea>
              <div class="invalid-tooltip" style="z-index: 501">
                Zadajte sprievodný text!
              </div>
            </div>
          </div>
        </div>
      <div class="form-row mb-2">
        <div class="col-md-12">
           <textarea id="newTextEditor" name="newTextEditor" style="z-index: -5"></textarea>
        </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-success mt-2 bigButton" id="submit2">Nahrať</button>
      </div>
      </form>

    </div>
  </div>
 </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script src="<?="//" .URL. 'views/article/js/sk-SK.js';?>"></script>
<script src="<?="//" .URL. 'views/article/js/newArticleScripts9.js';?>"></script>
<script>
  
  $(document).ready(function() {
   document.getElementById('body').classList.remove('d-none');
   document.getElementById('body').classList.add('animated');
   document.getElementById('body').classList.add('fadeIn');
  });
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#articlePhotoMain').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#titlePhoto").change(function(){
      readURL(this);
  });
</script>