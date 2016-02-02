$(function () {

    var vUname = /^([a-z0-9_-]){3,40}$/i;
    var vUemail = /^\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-+.]\w+)*$/;
    var vUmobile = /^1\d{10}$/;
    var vCname = /^[\u0391-\uFFE5]{2,40}$/; ;

    function $trim(arg) {
        return $.trim(arg);
    }

    /* 返回地址栏参数的值 */
    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }

    //  记住用户名
    // $("#re_uname").change(function () {
    // $("#re_uname").val($("#re_uname").prop("checked")?"1":"0");
    // }); 
    /* 自动登录 */
    $("#auto_login").change(function () {
        $("#auto_login").val($("#auto_login").prop("checked") ? "1" : "0");
    });

    $("#uName,#uPwd")
	.focus(function () {
	    var sEmail = $("#uName").val()
	    if ($trim(sEmail) == "用户名/邮箱/手机号") {
	        $("#uName").val("");
	    }
	    $(this).attr("class", "txt_blue2-260-30");
	    if ($(this).attr("id") == "uName") {
	        $("#e_tips").attr("class", "").html("");
	    } else if ($(this).attr("id") == "uPwd") {
	        $("#p_tips").attr("class", "").html("");
	    }
	})
	.blur(function () {
	    $(this).attr("class", "txt_gray3-260-30");
	});


    function LoginValidate() {
        var sUname = $trim($("#uName").val());
        var sUpwd = $trim($("#uPwd").val());
        //if (!(vUname.test(sUname) || vUemail.test(sUname) || vUmobile.test(sUname) || vCname.test(sUname))) {
        if(!vUname){
            $("#uName").attr("class", "txt_red2-260-30");
            $("#e_tips").attr("class", "cred").html("请输入帐号/邮箱/手机号");
        } else if (sUpwd.length < 6 || sUpwd.length > 20) {
            $("#uPwd").attr("class", "txt_red2-260-30");
            $("#p_tips").attr("class", "cred").html("请输入正确的密码");
        } else {
            //            $("#btns").hide();
            //            $("#btns2").show();
            //			alert("通过传不同的参数让用户登录成功后跳到不同的页面,如无传参，则哪里来回哪里去（刚刚您从test.html来的，现在登录成功了，然后返回到test.html去）");
            //	
                    var data = {
                        "username":sUname,
                        "password":sUpwd,
                            "<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>"
                    }
                        $.ajax({
                            type: 'POST',
                            url: "../login/checklogin",
                            data: 'data=' + JSON.stringify(data),

                            success: function(result) {
			    if (result == 0) {//如果帐号不存在,提示
		                    $("#p_tips").attr("class", "cred").html("您输入的账号不存在，请核对后重新输入");
		                } else if (result == -1) {//如果密码不正确，提示
		                    $("#p_tips").attr("class", "cred").html("您输入的账号和密码不匹配，请重新输入");
		                } else if (result == 1) {//如果输入正确
                                                location.href = "http://www.rfgxy.com";
		                }
                            }
                        });
            // $.post("http://www.rfgxy.com/ashx/verificationLogin.aspx", $("#loginForm").serialize()).done(function (d) {
            //     if (d == "0") {//如果帐号不存在,提示
            //         $("#p_tips").attr("class", "cred").html("您输入的账号不存在，请核对后重新输入");
            //     } else if (d == "2") {//如果密码不正确，提示
            //         $("#p_tips").attr("class", "cred").html("您输入的账号和密码不匹配，请重新输入");
            //     } else if (d == "1") {//如果输入正确
            //         document.getElementById("loginForm").action = "http://www.rfgxy.com/newloginOk.aspx";
            //         document.getElementById("loginForm").submit();
            //     } else if (d == "3") {//如果输入正确
            //         //$("input[name='callback']").val('http://www.rfgxy.com/topic/act/20130724/');
            //         $("input[name='callback']").val('http://www.rfgxy.com/');
            //         //alert($("input[name='callback']").val());
            //         //                    $("input[name='callback']").val('http://www.rfgxy.com/topic/act/20130724/');
            //                             document.getElementById("loginForm").action = "http://www.rfgxy.com/newloginOk.aspx";
            //                             document.getElementById("loginForm").submit();
            //     }
            // });
        }
    }


    $("#loginForm").delegate("#login", "click", LoginValidate);

    $("#uName,#uPwd").keydown(function (event) {
        if (event.which == 13) {
            LoginValidate();
        }
    });


});