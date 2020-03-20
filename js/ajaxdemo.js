$(doccument).ready(function(){
    $(Document).on("click",".btnSend",function(){
        $.ajax({
            type: "POST",
            url: "ajaxdemo.php",
            data: { qt:quantity },
            dataType : "text",
            success:function(response){
                console.log(response);

            }
        })
    });
});