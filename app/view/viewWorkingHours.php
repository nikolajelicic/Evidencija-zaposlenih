<div class="row">
    <div class="col-xl-6 offset-xl-3 text-center mt-5">
        <h3>Upisivanje radnih sati</h3>
        <div class="form-group">
            <select class="form-control" id="month">
                <option value="januar">Januar</option>
                <option value="februar">Februar</option>
                <option value="mart">Mart</option>
                <option value="april">April</option>
                <option value="maj">Maj</option>
                <option value="jun">Jun</option>
                <option value="avgust">Avgust</option>
                <option value="septembar">Septembar</option>
                <option value="oktobar">Oktobar</option>
                <option value="novembar">Novembar</option>
                <option value="decembar">Decembar</option>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" id="hours">
                <?php
                    for($i=0;$i<300;$i++){
                        echo "<option value='$i'>".$i."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-success" id="writeHours">Sacuvaj sate</button>
        </div>
        <div id="message1"></div>
    </div>
</div>
<script>
    $("#writeHours").click(function(){
        $("#message1").empty()
        var month = $("#month").val()
        var year = (new Date).getFullYear()
        var id = $("#userId").html()
        var hours = $("#hours").val()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/app/object/writeHours.php',
            type: 'POST',
            data:{month:month,year:year,hours:hours,id:id},
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                    if(data[i].status==true){
                        $("#message1").append("<div class='alert alert-success'><strong>"+data[i].message+"</strong></div>")
                    }else{
                        $("#message1").append("<div class='alert alert-danger'><strong>"+data[i].message+"</strong></div>")
                    }
                }
            }
        })
    })
</script>