    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>public/libs/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <script src="<?=base_url()?>public/js/app.min.js"></script>
    <script src="<?=base_url()?>public/js/app.js"></script>
    <script src="<?=base_url()?>public/plugins/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?=base_url()?>public/js/fileinput.min.js"></script>
    <script>
      $(document).ready(function(){
          article.init();
          qs.init();
          eval.init();
           $('#userfile').fileinput();
           $("#select2").select2();
           $('.clockpicker ').clockpicker({
          autoclose: true
          });
      });
        
        <?php if (isset($ckeditor)): ?>
            <?php if ($ckeditor): ?>
               CKEDITOR.replace( 'cue_pos', {
                allowedContent: true
              });   
            <?php endif ?>
        <?php endif; ?>
    
    </script>
  </body>
</html>
