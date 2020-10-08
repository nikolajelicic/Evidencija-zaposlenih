<div class="modal fade" id="boxes1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Spisak kutija</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center" id="listOfBoxes">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" name="logout" data-dismiss="modal">IZADJI</button>
        </div>
      </div>
    </div>
</div>
<script>
$(document).ready(function(){
        $("#listOfBoxes").empty()
        $.ajax({
            url:'http://localhost/evidencija%20zaposlenih/admin/app/object/typesOfBoxes.php',
            type:'POST',
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(i=0;i<data.length;i++){
                    $("#listOfBoxes").append("<p><strong>Dimenzija: </strong>"+data[i].dimension+" "+"(cena:"+data[i].price+" "+"din"+")"+"</p>")
                }
            }
        })
    })
</script>

