<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <p><strong>Ukupno uradjeno kutija za:</strong></p>
        <form>
            <div class="form-group">
                <label for="month"><strong>Mesec:</strong></label>
                <select id="month" class="form-control">
                    <option value="januar">Januar</option>
                    <option value="februar">Februar</option>
                    <option value="mart">Mart</option>
                    <option value="april">April</option>
                    <option value="maj">Maj</option>
                    <option value="jun">Jun</option>
                    <option value="avgust">Avgust</option>
                    <option value="septembar">Septembar</option>
                    <option value="oktobar">Oktovar</option>
                    <option value="novembar">Novembar</option>
                    <option value="decembar">Decembar</option>
                </select>
                <label for="year"><strong>Godina:</strong></label>
                <select id="year" class="form-control">
                    <?php
                        for($i=2020;$i<2100;$i++){
                            echo "<option value='$i'>".$i."</option>";
                        }
                    ?>
                </select>
                <button id="show" class="btn btn-success mt-3">Prikazi</button>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row" id="showData">
            
        </div>
    </div>
</div>
<script>
       $("#show").click(function(){
        var month = $("#month").val()
        var year = $("#year").val()
        $("#showData").empty()
        $.ajax({
            url:'http://localhost/evidencija%20zaposlenih/admin/app/object/done.php',
            type:'POST',
            data:{month:month,year:year},
            dataType:'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                   if(data[i].status==true){
                    $("#showData").append("<div class='col-xl-4 border'<p><strong>Dimenzija kutije: </strong>"+data[i].dimension+"</p>"+
                    "<p><strong>Uradjeno(kom): </strong>"+data[i].pieces+"</p>"+
                    "<p><strong>Ukupna cena uradjenih kutija: </strong>"+data[i].income+" "+"din</p></div>")
                   }else{
                       window.alert("Nema podataka za izabrani mesec i godinu")
                   }
                }
            }
        })
    })
</script>