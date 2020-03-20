$(doccument).ready(function(){
    getCartInfo();
    $(Document).on("click",".btnSend",function(){
        var proId = $('#hiddenProId').val();
        var quantity = $("#txtQuantity") 
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
 function getCartInfo(){
    $.ajax({
        type: "POST",
        url: "ajaxdemo.php",
        data: { qt:quantity },
        dataType : "text",
        success:function(response){
            console.log(response);
        $('.cart-list').html(response.list)
        }
    })
 }