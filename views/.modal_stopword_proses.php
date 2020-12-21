<!-- Proses Edit -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Stopword</h4>
        <button type="button" class="close pt-4" data-dismiss="modal">&times;</button>
      </div> 
      <form id="form" enctype="multipart/form-data">
        <div class="modal-body" id="modal-edit">
          <div class="form-group">
            <label class="control-label" for="stopword">Stopword</label>
            <input type="hidden" name="id_stopword" id="id_stopword">
            <input type="text" name="stopword" class="form-control" id="stopword" required>
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
  $(document).on("click", "#edit_stopword", function(){
    
    var id_stopword = $(this).data('id_stopword');
    var stopword = $(this).data('stopword');
    $("#id_stopword").val(id_stopword);
    $("#stopword").val(stopword);
  })

  $(document).ready(function(e){
    $("#form").on("submit", (function(e) {
      e.preventDefault();
      $.ajax({
        url  : 'models/proses_edit_stopword.php',
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