<div class="modal fade" id="modalEditWorker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header col-xl-8 offset-xl-2">
          <h5 class="modal-title">Izmena emaila i sifre radnika</h5>
        </div>
        <div class="modal-body text-center radnikk">
          <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 offset-xl-2">
                        <div id="message"></div>
                        <div class="form-group">
                            <label for="editEmail">Email:</label>
                            <input class="form-control text-center" type="text" id="editEmail">
                            <input class="form-control d-none" type="text" id="idWorkerID">
                        </div>
                        <div class="form-group">
                            <label for="editPass">Sifra:</label>
                            <input class="form-control text-center" type="text" id="editPass">
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" id="saveChanges">Sacuvaj izmene</button>
          <button type="button" class="btn btn-danger" name="logout" data-dismiss="modal">Odustani</button>
        </div>
      </div>
    </div>
</div>
<script>
    $("#saveChanges").click(function(){ 
        $("#message").empty()
        var email = $("#editEmail").val()
        var pass = $("#editPass").val()
        var id = $("#idWorkerID").val()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/edit.php',
            type: 'POST',
            data: {id:id,email:email,pass:pass},
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                    if(data[i].status==true){
                        $("#message").append("<p><strong class='alert alert-success'>"+data[i].message+"</strong></p>")
                    }else{
                        $("#message").append("<p><strong class='alert alert-danger'>"+data[i].message+"</strong></p>")
                    }
                }
            }
        })
    })
</script>
