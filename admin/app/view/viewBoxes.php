<div class="row">
    <div class="col-xl-4 mt-2">
        <button id="addNewBoxes" data-toggle="modal" data-target="#modalNewBoxes" class="btn btn-info">Dodaj novu vrstu kutija</button>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 offset-xl-2 mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dimenzija kutije</th>
                    <th>CENA(kom)</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="boxesTable">
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        function boxes(){
            $("#boxesTable").empty()
            $.ajax({
                url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/typesOfBoxes.php',
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    for(var i=0;i<data.length;i++){
                        $("#boxesTable").append("<tr><td>"+data[i].dimension+"</td>"
                                                +"<td>"+data[i].price+" din"+"</td>"
                                                +"<td><button data-toggle='modal' data-target='#modalEditPrice' value="+data[i].id+" id='box"+data[i].price+"' class='btn btn-primary izmeniCenu'>Izmeni cenu</>"+"</td>"
                                                +"<td><button class='btn btn-danger deleteBoxes' id='delete"+data[i].id+"'>Obrisi</button>"+"</td></tr>")
                        $("#saveNewPrice").val(data[i].id)
                    }
                    $("button.izmeniCenu").click(function(){
                        $("#message2").empty()
                        var boxId = $(this).val()
                        var boxPrice = $(this).attr('id').substring(3,$(this).attr('id').length)
                        console.log(boxPrice,boxId)
                        $("#newPrice").val(boxPrice)
                        $("#saveNewPrice").val(boxId)
                    })
                    $("button.deleteBoxes").click(function(){
                        $("#boxesTable").empty()
                        var boxId = $(this).attr('id').substring(6,$(this).attr('id').length)
                        //console.log(boxId)
                        $.ajax({
                            url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/deleteBox.php',
                            type: 'POST',
                            data: {boxId:boxId},
                            dataType: 'JSON',
                            success: function(data){
                                //console.log(data)
                                for(var i=0;i<data.length;i++){
                                    if(data[i].status==true){
                                        boxes()                                    
                                    }else{
                                        window.alert("Doslo je do greske")
                                    }
                                }
                            }
                        })
                    })
                }
            })
        }
        boxes()
        $("#saveNewPrice").click(function(){
            $("#message2").empty()
            var id = $("#saveNewPrice").val()
            var price = $("#newPrice").val()

            $.ajax({
                url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/editPrice.php',
                type: 'POST',
                data: {id:id,price:price},
                dataType: 'JSON',
                success: function(data){
                    //console.log(data)
                    for(var i=0;i<data.length;i++){
                        if(data[i].status==true){
                            $("#message2").append("<p><strong class='alert alert-success'>"+data[i].message+"</strong></p>")
                            boxes() 
                        }else{
                            $("#message2").append("<p><strong class='alert alert-danger'>"+data[i].message+"</strong></p>")
                        }
                    }
                }
            })
        })
        $("#saveNewBoxes").click(function(){
        $("#message3").empty()
        var dimensione = $("#dimensioneNewBoxes").val()
        var price = $("#priceNewBoxes").val()

        $.ajax({
            url:'http://localhost/evidencija%20zaposlenih/admin/app/object/addNewBoxes.php',
            type: 'POST',
            data: {dimensione:dimensione,price:price},
            dataType: 'JSON',
            success: function(data){
                console.log(data)
                for(var i=0;i<data.length;i++){
                    if(data[i].status==true){
                        $("#message3").append("<p><strong class='alert alert-success'>"+data[i].message+"</strong></p>")
                        $("#boxesTable").empty()
                        boxes()
                    }else{
                        $("#message3").append("<p><strong class='alert alert-danger'>"+data[i].message+"</strong></p>")
                    }
                }
            }
        })
    })
    $("#addNewBoxes").click(function(){
        $("#message3").empty()
        $("#dimensioneNewBoxes").val('')
        $("#priceNewBoxes").val('')
    })
    })
</script>