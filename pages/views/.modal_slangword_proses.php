<!-- Proses Edit -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Slangword</h4>
        <button type="button" class="close pt-4" data-dismiss="modal">&times;</button>
      </div> 
      <form id="form" enctype="multipart/form-data">
        <div class="modal-body" id="modal-edit">
          <div class="form-group">
            <label class="control-label" for="slangword">Slangword</label>
            <input type="hidden" name="id_slangword" id="id_slangword">
            <input type="text" name="slangword" class="form-control" id="slangword" required>
          </div>
          <div class="form-group">
            <label class="control-label" for="kata_asli">Kata Asli</label>
            <input type="text" name="kata_asli" class="form-control" id="kata_asli" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" name="edit" value="Simpan">
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
  $(document).on("click", "#edit_slangword", function(){
    
    var id_slangword = $(this).data('id_slangword');
    var slangword = $(this).data('slangword');
    var kata_asli = $(this).data('kata');
    $("#id_slangword").val(id_slangword);
    $("#slangword").val(slangword);
    $("#kata_asli").val(kata_asli);
  })

  $(document).ready(function(e){
    $("#form").on("submit", (function(e) {
      e.preventDefault();
      $.ajax({
        url  : 'models/proses_edit_slangword.php',
        type : 'POST',
        data : new FormData(this),
        contentType : false,
        cache : false,
        processData : false,
        success : function(msg) {
          $('.table').html(msg);
        }
      });
    }));
  })
</script>