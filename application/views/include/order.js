
$(function () {
    /* 全选 */
    $("#all1,#all2").click(function () {
        var $checkboxs = $("#orderTable input[type='checkbox'][id!='all1'][id!='all2']");
        $checkboxs.prop("checked", !$checkboxs.prop("checked"));
        if ($(this).attr("id") == "all1") {
            $("#all2").prop("checked", $("#all1").prop("checked"));
        } else if ($(this).attr("id") == "all2") {
            $("#all1").prop("checked", $("#all2").prop("checked"));
        }
    });

    function jisuan() {
        var $good_price = $("#good_price").html(); /*商品金额*/
        var $total_coupon = $("#total_coupon").html(); /*优惠卷*/
        var $total_pay = parseInt($good_price) - parseFloat($total_coupon);
        $("#total_pay").html($total_pay < 0 ? 0 : $total_pay);
    }

    /* 关闭优惠卷 */
    $("#closeCoupons").click(function () {
        $("#cbxCoupons").prop("checked", false);
        $("#cntCoupons").hide();
        $("#total_coupon").html("0.00");
        $("#cntCoupons :radio").prop("checked", false);
        jisuan();
    });

    /* 显示优惠卷 */
    $("#cbxCoupons").click(function () {
        if ($(this).prop("checked")) {
            $("#cntCoupons").show();
        } else {
            $("#cntCoupons").hide();
            $("#total_coupon").html("0.00");
            $("#cntCoupons :radio").prop("checked", false);
            jisuan();
        }
    });

    /*优惠卷*/
    $("#cntCoupons").delegate(":radio", "click", function () {
        $this_val = $(this).attr("price");
        $("#total_coupon").html($this_val + ".00");
        var couse = $(this).attr("couse");
        if (couse != "") {
            if (confirm("使用本券时，系统会自动删除不符合本券使用的课时")) {
                $("#orderTable tr[id!='" + couse + "']").each(function () {
                    if ($(this).attr('title') != undefined) {
                        delCart1($(this).attr('title'));

                    }
                    else {
                        jisuan();
                    }
                });
                jisuan();
            }
            return false;
        }
        else {
            jisuan();
        }
    });

    /* 结算1 */
    $("#pay1").click(function () {

        var ifed = true;

        if (!ifed) {
            alert("请选择您要购买的课时");
            return;
        } else {
            var $cbxCoupons = $("#cbxCoupons").prop("checked");
            if ($cbxCoupons == true) {
                var $cntCoupons = $("#cntCoupons input[type='radio']");
                var ifed2 = false;
                for (var i = 0; i < $cntCoupons.length; i++) {
                    var $checked2 = $($cntCoupons[i]).prop("checked");
                    ifed2 = $checked2;
                    if ($checked2 == false) {
                        continue;
                    } else if ($checked2 = true) {
                        break;
                    }
                }
                if (ifed2 == false) {
                    alert("请选择您要使用的优惠劵");
                    return;
                }
            }
            var $cbxCoupons1 = $("#cbxCoupons1").prop("checked");
            if ($cbxCoupons1 == true) {
                document.getElementById("form1").action = "coin_pay.aspx";
                document.getElementById("form1").submit();
                return false;
            }
            else {
                /*location.href = "/home/order/confirmOrder.aspx";*/
                document.getElementById("form1").action = "confirmOrder.aspx";
                document.getElementById("form1").submit();
                return false;
            }
        }
    });

    /* 支付宝支付 */
    $("#pay2").click(function () {
        if ($("#ordertype").val() == "1") {
            $("#paytype").val('4');
        }
        else {
            $("#paytype").val('4');
        }
        document.getElementById("form1").action = "createOrder.aspx";
        document.getElementById("form1").submit();
    });

    /* 结算3 */
    $("#pay3").click(function () {
        var $radio2 = $("#payType2 input[type='radio']");
        var $radio3 = $("#payType3 input[type='radio']");
        var ifed = false;
        for (var i2 = 0; i2 < $radio2.length; i2++) {
            if ($($radio2[i2]).prop("checked")) {
                ifed = true;
                break;
            }
        }
        if (!ifed) {
            for (var i3 = 0; i3 < $radio3.length; i3++) {
                if ($($radio3[i3]).prop("checked")) {
                    ifed = true;
                    break;
                }
            }
        }

        if (!ifed) {
            alert("请选择您要支付的方式");
        } else {
            /*location.href = "orderOk.aspx";*/
            if ($("#ordertype").val() == "1") {
                $("#paytype").val('4');
            }
            else {
                $("#paytype").val('2');
            }
            if ($("#itpcredittemp").val() == "1") {
                alert($("#itpcredittemp").val());
            }
            document.getElementById("form1").action = "createOrder.aspx";
            document.getElementById("form1").submit();
            return false;
        }
    });

    $("#cbxCoupons1").click(function () {
        var $cbxCoupons1 = $("#cbxCoupons1").prop("checked");
        if ($cbxCoupons1 == true) {
            $("#leddd").html("消费技成币");
            $("#total_coupon").html($("#iptlearnercoin").val());
            $("#danwei").html("个");
            $("#total_pay").html("0");
        }
        else {
            $("#leddd").html("消费技成币");
            $("#total_coupon").html("0");
            $("#danwei").html("个");
            $("#total_pay").html($("#iptlearnercoin").val());
          }

    })
    $("#cbxCoupons2").click(function () {
        var $cbxCoupons2 = $("#cbxCoupons2").prop("checked");
        if ($cbxCoupons2 == true) {
            $("#itpcredittemp").val($("#iptlearnercoin").val());
            $("#leddd").html("消费技成币");
            $("#total_coupon").html($("#iptlearnercoin").val());
            $("#danwei").html("个");
            $("#total_pay").html($("#payallmoney").val() - $("#iptlearnercoin").val());
        }
        else {
            $("#itpcredittemp").val(0);
            $("#leddd").html("消费技成币");
            $("#total_coupon").html(0);
            $("#danwei").html("个");
            $("#total_pay").html($("#payallmoney").val());
        }
        //$("#itpcredittemp").val(1);
        //        $("#leddd").html("消费技成币");
        //        $("#total_coupon").html($("#iptlearnercoin").val());
        //        $("#danwei").html("个");
        //        $("#total_pay").html("0");
    })
    $("#pay4").click(function () {
        $.post("/orderLesson/coin_pay_postdata.aspx", { 'card_id': $("#card_id").val() }).done(function (d) {
            if (d == "支付成功") {
                alert("支付成功");
                window.parent.location.href = "/orderLesson/payedLesson.aspx";
            }
            else {
                alert(d);
            }
        });
    });
    /* 批量删除 */
    $("#batchRemove").click(function () {
        var $checkboxs2 = $("#orderTable input[type='checkbox'][id!='all1'][id!='all2']");
        var ifed = true;
        for (var i = 0; i < $checkboxs2.length; i++) {
            var $checked = $($checkboxs2[i]).prop("checked");
            if (!$checked) {
                ifed = false;
                continue;
            } else if ($checked) {
                ifed = true;
                break;
            }
        }
        if (!ifed) {
            alert("请选择您要删除的课时");
        } else {
            if (confirm("确定删除吗？")) {
                alert("批量删除中...");
            }
        }
    });


    /* 订单详情 */
    $("#orderDetails").click(function () {
        if ($("#orderTable").css("display") == "block") {
            $("#orderTable").css("display", "none");
            $("#orderSh").addClass("orderPut").removeClass("orderUp");
        } else if ($("#orderTable").css("display") == "none") {
            $("#orderTable").css("display", "block");
            $("#orderSh").removeClass("orderPut").addClass("orderUp");
        }
    });


});
/*=====================================================*/
function delCart(id) {
    if (confirm("确定删除吗？")) {
        $.post("active.ashx",
                {
                    "id": id, "action": "delete"
                }, function (data) {
                    alert(data);
                    window.location.replace("shoppingCart.aspx");
                });
    }
        }
        function delCart1(id) {  
                $.post("active.ashx",
                {
                    "id": id, "action": "delete"
                }, function (data) {
                    //alert(data);
                    window.location.replace("shoppingCart.aspx");
                });
        }
/* 清空购物车 */
function delCartAll(id) {
    if (confirm("确定要清空购物车吗？")) {
        $.post("active.ashx",
                {
                    "id": id, "action": "deleteAll"
                }, function (data) {
                    alert(data);
                    window.location.replace("shoppingCart.aspx");
                });
    }
}
