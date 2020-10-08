<div class="row">
    <div class="col-xl-6 offset-xl-3 text-center">
        <h2 class="mb-5">Promena emaila i sifre</h2>
        <div id="message"></div>
        <div class="form-group">
            <input type="text" id="email" class="form-control text-center">
        </div>
        <div class="form-group">
            <input type="text" id="password" class="form-control text-center">
        </div>
        <div class="form-group">
            <button id="save" class="btn btn-success">Sacuvaj</button>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var id = $("#userId").html()
    //console.log(id)
    $.ajax({
        url: 'http://localhost/evidencija%20zaposlenih/app/object/getInfo.php',
        type: 'POST',
        data: {id:id},
        dataType: 'JSON',
        success: function(data){
            //console.log(data)
            for(var i=0;i<data.length;i++){
                $("#email").val(data[i].email)
                $("#password").val(data[i].pass)
            }
        }
    })

    $("#save").click(function(){ 
        $("#message").empty()
        var email = $("#email").val()
        var pass = $("#password").val()
        var id = $("#userId").html()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/app/object/edit.php',
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
})
</script>