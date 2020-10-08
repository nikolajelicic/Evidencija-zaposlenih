$(document).ready(function(){
    $("#homePage").click(function(){
        location.reload(true);
    })

    $("#newWorker").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewNewWorker.php',
            type: 'POST',
            success: function(data){
                //console.log(data)
                $("#centralPage").append(data)
            }
        })
    })  

    $("#allWorker").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewAllWorker.php',
            type: 'POST',
            success: function(data){
                //console.log(data)
                $("#centralPage").append(data)
            }
        })
    })

    $("#done").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewDone.php',
            type: 'POST',
            success: function(data){
                $("#centralPage").append(data)
            }
        })
    })

    $("#boxes").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewBoxes.php',
            type: 'POST',
            success: function(data){
                $("#centralPage").append(data)
            }
        })
    })
    $("#payTheSalary").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewPayTheSalary.php',
            type: 'POST',
            success: function(data){
                $("#centralPage").append(data)
            }
        })
    })
    $("#doneBoxes1").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/admin/app/view/viewDoneBoxes.php',
            type: 'POST',
            success: function(data){
                $("#centralPage").append(data)
            }
        })
    })
})
