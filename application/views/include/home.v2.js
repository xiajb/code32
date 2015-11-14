
$(function () {

    //$("#showlist #" + $.cookie("payedLesson_a")).addClass("on").siblings("a").removeClass("on");
    $("#showlist a").click(function () {
        //$.cookie("payedLesson_a", $(this).attr("id"));
        window.location.href = "payedLesson.aspx?type=" + $(this).attr("data");
    });

    $("#showlist #sltOrderState").change(function () {
        var $sltText = $(this).find("option:selected").val();
        //alert($sltText);
        window.location.href = "order.aspx?type=" + $sltText;
        // window.location.reload();
    });

    /*取消订单*/
    $("#myorder .cancelOrder").click(function () {
        if (confirm("确定取消订单吗?")) {
            //alert("取消了订单");
            var _orderid = $(this).attr("data-orderid");
            $.post("/ashx/order/HandleOrder.aspx", { "action": "cancel", "orderid": _orderid }, function (msg) { 
                window.location.reload();
            });
        } 
    });
});