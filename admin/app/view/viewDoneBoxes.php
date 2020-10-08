<div class="row">
    <div class="col-xl-12 text-center">
        <h2 class="mb-5">Upisivanje uradjenih kutija za odredjeni mesec</h2>
        <div id="message3" class="col-xl-4 offset-xl-4"></div>
    </div>
    <div class="col-xl-8 offset-xl-2 text-center mt-5">
        <div class="form-group">
            <select id="month1" class="form-control">
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
            <select id="year1" class="form-control">
                <?php
                    echo "<option value=".date("Y").">".date("Y")."</option>";
                ?>
            </select>
        </div>
        <div class="form-group">
        
        </div>
        <div class="form-group">
            <select id="allBoxes" class="form-control">
                
            </select>
        </div>
        <div class="form-group">
            <input placeholder="Unesi broj uradjenih kutija" type="number" id="number" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success" id="save1">Sacuvaj</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/typesOfBoxes.php',
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                for(var i=0;i<data.length;i++){
                    $("#allBoxes").append("<option value="+data[i].id+">"+data[i].dimension+"</option>")
                }
            }
        })

        $("#save1").click(function(){
            var month = $("#month1").val()
            var year = $("#year1").val()
            var number = $("#number").val()
            var id = $("#allBoxes").val()
            $("#message3").empty()
            $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/check.php',
            type: 'POST',
            data:{month:month,year:year,number:number,id:id},
            dataType: 'JSON',
            success: function(data){
                for(var i=0;i<data.length;i++){
                    if(data[i].status==true){
                        $("#message3").append("<div class='alert alert-success'><p>"+data[i].message+"</p></div>")
                    }else{
                        $("#message3").append("<div class='alert alert-danger'><p>"+data[i].message+"</p></div>")
                    }
                }
            }
        })
        })
    })
</script>