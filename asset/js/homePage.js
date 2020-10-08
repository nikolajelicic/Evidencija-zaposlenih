$(document).ready(function(){
    $("#homePage").click(function(){
        location.reload(true);
    })
    $("#workingHours").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/app/view/viewWorkingHours.php',
            type: 'POST',
            success: function(data){
                //console.log(data)
                $("#centralPage").append(data)
            }
        })
    })

    $("#edit").click(function(){
        $("#centralPage").empty()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/app/view/viewEdit.php',
            type: 'POST',
            success: function(data){
                $("#centralPage").append(data)
            }
        })
    })
})
