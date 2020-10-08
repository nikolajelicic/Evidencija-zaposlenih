<div class="row">
    <div class="col-xl-12 col-sm-5">
        <input id="salaryMonth" type="text" class="form-control col-xl-6 offset-xl-3 text-center mb-2 mt-2" placeholder="Pretraga tabele">
        <div id="message4"></div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>IME I PREZIME</th>
                    <th>MESEC</th>
                    <th>GODINA</th>
                    <th>ZARADJENO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tableSalary">
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#tableSalary").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/getSalaryInfo.php',
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                    $("#tableSalary").append("<tr><td>"+data[i].name+" "+data[i].surname+"</td>"+
                    "<td>"+data[i].month+"</td>"+
                    "<td>"+data[i].year+"</td>"+
                    "<td class='salary'>"+data[i].salary+"</td>"+
                    "<td><button value="+data[i].salary+" id=id"+data[i].id+" class='btn btn-primary paysOff"+" "+data[i].month+"'>ISPLATI</button></td></tr>")
                }
                $("button.paysOff").click(function(){
                    $("#message4").empty()
                    var workerId = $(this).attr('id').substring(2,$(this).attr('id').length)
                    var month = $(this).attr('class').substring(23,$(this).attr('class').length)
                    var year = (new Date).getFullYear()
                    var salary = $(this).val()
                    $.ajax({
                        url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/payTheSalary.php',
                        type: 'POST',
                        data: {workerId:workerId,month:month,year:year,salary:salary},
                        dataType: 'JSON',
                        success: function(data){
                            //console.log(data)
                            for(var i=0;i<data.length;i++){
                                if(data[i].status==true){
                                    $("#message4").append("<div class='alert alert-success alert-dismissible fade show'role='alert'<strong>"+
                                    data[i].message+"</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>")
                                }else{
                                    $("#message4").append("<div class='alert alert-danger alert-dismissible fade show'role='alert'<strong>"+
                                    data[i].message+"</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>")
                                }
                            }
                        }
                    })
                })
            }

        })

        $("#salaryMonth").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableSalary tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            })
        })
    })
</script>