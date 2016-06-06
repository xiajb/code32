// JavaScript Document

var start = 3;
var step = -1;


$(document).ready(function () {

    $("body").append("<div class='liuyanbantop'>"
				   + "    <ul>                 "
				   + "        <li id='sc' style='text-align:right;'><img id='showliuyan' src='http://images.qfdlqz.com/leaveplay_01.gif' style='cursor:pointer;' /></li>"
				   + "        <li>&nbsp;</li><li>留言内容：</li><li><textarea id='lycontent' style='width:200px; height:70px;overflow:hidden;border:solid 1px #aaaaaa;' ></textarea></li>"
				   + "        <li>&nbsp;</li><li>手机号码：</li><li><input id='lyphone' type='text' style='width:200px;'/></li><li>&nbsp;</li>"
				   + "        <li>请点击发送提交留言&nbsp;<img id='fasong' src='http://images.qfdlqz.com/leavesend.gif' style='cursor:pointer; vertical-align:middle;border:solid 1px #aaaaaa;'/></li>"
				   + "        <li>&nbsp;</li>"
				   + "     </ul>"
                   + "  </div>"
                   + "<div class='liuyanbantop2'><img id='showliuyan' src='http://images.qfdlqz.com/leave_small.gif' style='cursor:pointer;' /></div><div class='liuyanbantop3'></div>");

    $(".liuyanbantop2").click(function () {
        $(this).hide();
        $(".liuyanbantop").show();
    });

    $("#showliuyan").click(function () {
        $(".liuyanbantop").hide();
        $(".liuyanbantop2").show();
    });

    $("#fasong").click(function () {
        if ($.trim($("#lycontent").val()).length < 1) {
            //alert("请填写留言内容");
            $("#lycontent").css({"border":"solid 1px red"});
            $("#lycontent").html("").focus();
        } else if ($.trim($("#lyphone").val()).length < 1) {
            //alert("请填写手机号码");
            $("#lyphone").css({ "border": "solid 1px red" });
            $("#lyphone").val("").focus();
        } else if (!(/^(13[0-9]|15[0-9]|18[0-9])\d{8}$/).test($("#lyphone").val())) {
            alert("请输入正确的手机号码");
            $("#lyphone").css({ "border": "solid 1px red" });
            $("#lyphone").focus();
        } else {
            if (confirm("请点击确定完成留言的发送,我们将尽快联系您,谢谢!")) {
                $.ajax({
                    type: "get",
                    url: "/ashx/studentsound/CreateMsg.ashx",
                    cache: false,
                    data: "content=" + encodeURIComponent($("#lycontent").val()) + "&phone=" + encodeURIComponent($("#lyphone").val()) + "",
                    success: function (msg) {
                        //                       if(msg==95){
                        //                           $(".liuyanbantop").hide();
                        //                           $(".liuyanbantop3").html("<ul><li>留言重复!如紧急,请拨免费咨询:110-110-110</li></ul>").slideDown();
                        //                           $(".liuyanbantop2").show();
                        //                           $("#lycontent").val("");
                        //                           $("#lyphone").val("");
                        //                           start = 10;
                        //                           _count();
                        //                       }else if (msg>0) {
                        $(".liuyanbantop").hide();
                        $(".liuyanbantop3").html("<ul><li>留言成功!如紧急,请拨免费咨询:110-110-110</li></ul>").slideDown();
                        $(".liuyanbantop2").show();
                        $("#lycontent").val("");
                        $("#lyphone").val("");
                        start = 10;
                        _count();
                        //                        } else {
                        //                            $(".liuyanbantop").hide();
                        //                            $(".liuyanbantop3").html("<ul><li>留言失败,如紧急,请拨免费咨询:110-110-110</li><li>&nbsp;</li></ul>").slideDown();
                        //                            $(".liuyanbantop2").show();
                        //                            $("#lycontent").val("");
                        //                            $("#lyphone").val("");
                        //                            start = 10;
                        //                            _count();
                        //                        }
                    }
                });
            }
        }
    });


});



function _count() {
    start += step;
    if (start == 0) {
        $(".liuyanbantop3").html("").hide();
    }
    setTimeout("_count()", 1000);
}