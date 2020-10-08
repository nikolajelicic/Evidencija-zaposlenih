<div class="row">
    <div class="col-xl-8 offset-xl-2 mt-5 text-center">
      <div id="messageWorker"></div>
        <h1 class="mb-4">Dodavanje radnika</h1>
        <div class="row">
          <div class="col-xl-6 offset-xl-3">
            <div class="form-group">
              <input type="text" id="workerName" placeholder="Upisi ime" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="workerSurname" placeholder="Upisi prezime" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="workerEmail" placeholder="Upisi email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" id="workerPass" placeholder="Upisi sifru" class="form-control">
            </div>
            <div class="form-group">
              <select class="form-control" id="workPlaces"></select>
            </div>
            <div class="form-group">
              <button id="saveWorker" class="btn btn-success">Sacuvaj</button>
            </div>
          </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
      $.ajax({
          url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/allWorkPlaces.php',
          type: 'POST',
          dataType: 'JSON',
          success: function(data){
              //console.log(data)
              for(var i=0;i<data.length;i++){
                $("#workPlaces").append("<option value='"+data[i].id+"'>"+data[i].name+" "+"("+data[i].price+" "+"din"+")"+"</option>")
              }
          }
      })
    $("#saveWorker").click(function(){
    var name = $("#workerName").val()
    var surname = $("#workerSurname").val()
    var email = $("#workerEmail").val()
    var pass = $("#workerPass").val()
    var workPlaces = $("#workPlaces").val()
    $("#messageWorker").empty()
    //console.log(name,surname,email,pass,workPlaces)
    $.ajax({
      url:'http://localhost/evidencija%20zaposlenih/admin/app/object/addWorker.php',
      type:'POST',
      data:{name:name,surname:surname,email:email,pass:pass,workPlaces:workPlaces},
      dataType:'JSON',
      success: function(data){
        //console.log(data)
        for(var i=0;i<data.length;i++){
          if(data[i].status==true){
            $("#messageWorker").append("<div class='alert alert-success'><p><strong>"+data[i].message+"</strong></p></div>")
          }else{
            $("#messageWorker").append("<div class='alert alert-danger'><p><strong>"+data[i].message+"</strong></p></div>")
          }
        }
      }
    })
  })
  })
</script>