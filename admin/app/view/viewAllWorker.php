<div class="row">
    <div class="col-xl-12">
        <input class="form-control col-xl-4 mt-3 mb-3 offset-xl-4" placeholder="Upisi ime radnika" type="text" id="search">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>IME I PREZIME</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="listAllWorker">
            
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        var workerId = 0;
        var worker;
        function listAllWorker(){
            $("#listAllWorker").empty()
            $.ajax({
            url:'http://localhost/evidencija%20zaposlenih/admin/app/object/getAllWorker.php',
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                    $("#listAllWorker").append("<tr><td class='imeIprezime'>"+data[i].name+" "+data[i].surname+"</td>"+"<td>"+"<button value='"+data[i].name+" "+data[i].surname+"' id='info"+data[i].id+"' data-toggle='modal' data-target='#modalInfoWorker' class='btn btn-info info'>Informacije o radniku</button></td>"+"<td><button id='edit"+data[i].id+"' data-toggle='modal' data-target='#modalEditWorker' class='btn btn-primary edit'>Izmeni podatke</button></td>"+"<td><button id='delete"+data[i].id+"' data-toggle='modal' data-target='#modalDeleteWorker' class='btn btn-danger delete'>Obrisi radnika</button></td></tr>")
                    }
                    $("button.info").click(function(){
                        workerId = $(this).attr('id').substring(4,$(this).attr('id').length)
                        worker = $(this).val()
                        //console.log(worker)
                        $("#nameSurname").empty()
                        $("#aboutWorker").empty()
                            $.ajax({
                            url:'http://localhost/evidencija%20zaposlenih/admin/app/object/infoWorker.php',
                            type: 'POST',
                            data: {id:workerId},
                            dataType: 'JSON',
                            success: function(data){
                                //console.log(data)
                                for(var i=0;i<data.length;i++){
                                   if(data[i].status==true){
                                    $("#nameSurname").html(worker)
                                    $("#aboutWorker").append("<div class='col-xl-12'><p><strong>Mesec: </strong>"+data[i].month+"</p>"+
                                                        "<p><strong>Godina: </strong>"+data[i].year+"</p>"+
                                                        "<p><strong>Broj sati: </strong>"+data[i].number_workingHours+"</p>"+
                                                        "<p><strong>Plata: </strong>"+data[i].salary+"</p><hr></div>")
                                   }else{
                                    $("#nameSurname").html(worker)
                                    $("#aboutWorker").append("<p class='alert alert-danger'>"+data[i].message+"</div>")
                                   }
                                }
                            }
                        })
                    })

                    $("button.edit").click(function(){
                    workerId = $(this).attr('id').substring(4,$(this).attr('id').length)
                    $("#message").empty()
                    //console.log(workerId)
                    $.ajax({
                        url:'http://localhost/evidencija%20zaposlenih/admin/app/object/getEmailPass.php',
                        type: 'POST',
                        data: {id:workerId},
                        dataType: 'JSON',
                        success: function(data){
                            //console.log(data)
                            for(var i=0;i<data.length;i++){
                                $("#editPass").val(data[i].pass)
                                $("#editEmail").val(data[i].email)
                                $("#idWorkerID").val(data[i].id)
                            }
                        }
                    })
                })

                $("button.delete").click(function(){
                    workerId = $(this).attr('id').substring(6,$(this).attr('id').length)
                    $("#messageDelete").empty()
                    //console.log(workerId)
                })
            }
        })
        }
        listAllWorker()
        $("#deleteWorker1").click(function(){
            $("#messageDelete").empty()
            $.ajax({
                url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/deleteWorker.php',
                type: 'POST',
                data:{id:workerId},
                dataType: 'JSON',
                success: function(data){
                    //console.log(data)
                    for(var i=0;i<data.length;i++){
                        if(data[i].status==true){
                            $("#messageDelete").append("<p><strong class='alert alert-success'>"+data[i].message+"</strong></p>")
                        }else{
                            $("#messageDelete").append("<p><strong class='alert alert-danger'>"+data[i].message+"</strong></p>")
                        }
                    }
                }
            })
        })
        $(".osveziTabelu").click(function(){
            listAllWorker()
        })

        //pretraga tabele
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    })
</script>