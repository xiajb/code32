$(function () {


    var hash = {
        'qq.com': 'http://mail.qq.com',
        'gmail.com': 'http://mail.google.com',
        'sina.com': 'http://mail.sina.com.cn',
        '163.com': 'http://mail.163.com',
        '126.com': 'http://mail.126.com',
        'yeah.net': 'http://www.yeah.net/',
        'sohu.com': 'http://mail.sohu.com/',
        'tom.com': 'http://mail.tom.com/',
        'sogou.com': 'http://mail.sogou.com/',
        '139.com': 'http://mail.10086.cn/',
        'hotmail.com': 'http://www.hotmail.com',
        'live.com': 'http://login.live.com/',
        'live.cn': 'http://login.live.cn/',
        'live.com.cn': 'http://login.live.com.cn',
        '189.com': 'http://webmail16.189.cn/webmail/',
        'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
        'yahoo.cn': 'http://mail.cn.yahoo.com/',
        'eyou.com': 'http://www.eyou.com/',
        '21cn.com': 'http://mail.21cn.com/',
        '188.com': 'http://www.188.com/',
        'foxmail.coom': 'http://www.foxmail.com'
    };

    function Radom4() {
        var charactors = "abcd2ef3gh4ij5k6mn7pq8rst9uvwxyz";
        var value = '', i;
        for (j = 1; j <= 4; j++) {
            i = parseInt(35 * Math.random());
            value = value + charactors.charAt(i);
        }
        return value;
    }

    function gotoEmailHost(email) {
        var url = email.split('@')[1];
        window.open(hash[url]);
    }

    $("#look_email").click(function () {
        gotoEmailHost("820998919@qq.com");
    });

    $("#again_send2").click(function () {
        $.post("/emailregister/sendemail.aspx", { 'email': $("#iptemail").val(), 'url': $("#ipturl").val(), 'emailTemplate': 'findpassword' }).done(function (d) {
            if (d == "1") {
                alert("验证邮件已重发，成功！");
                /* 180秒后才能再获取 */
                $("#again_send2").hide();
                var $cdown_tips = $("#cdown_tips2");
                var i = 60;
                var fn = function () {
                    $cdown_tips.html(i + "秒后才能再次发送");
                    !i && $cdown_tips.hide() && $("#again_send2").show() && clearInterval(timer);
                    i--;
                };
                timer = setInterval(fn, 1000);
                fn();
                $cdown_tips.show();
            }
            else {
                alert("邮件发送失败");
            }
        });
    });

    var vUname = /^([a-z0-9_-]){5,15}$/i;
    var vUemail = /^\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-+.]\w+)*$/;
    var vUmobile = /^1\d{10}$/;

    function $trim(arg) {
        return $.trim(arg);
    }

    /*  1 */
    $("#uName").focus(function () {
        $("#uName").attr("class", "txt_blue1-240-30");
        $("#n_tips").attr("class", "cgray5").html("支持用户名/邮箱/手机号");
    });

    // $("#changeCode").click(function () {
    //     $("#imgYzm").attr("src", "http://www.jcpeixun.com/validatecode.aspx?id=" + Math.random());
    // });

    $("#fp_next").delegate("#fp_btn_next1", "click", function () {
        var sUname = $("#uName").val();
        // var sVcode = $("#vcode").val();
                    var value = gt_captcha_obj.getValidate();
                // phone = $("#umobile").val();
                value.username = sUname;
                result = JSON.stringify(value);

        if (!(vUemail.test(sUname) || vUmobile.test(sUname))) {
            $("#uName").attr("class", "txt_red1-240-30");
            $("#n_tips").attr("class", "cred").html("帐号不存在，请输入正确账号");
        // } else if (sVcode.length < 4) {
        //     $("#c_tips").attr("class", "cred").html("验证码不正确，请重新输入");
        } else {
            console.log(result);
                        $.ajax({
                            type: 'POST',
                            url: "../forget/check_user",
                            data: "value=" + result,

                            success: function(result) {
                                if (result == -10) {

                                    alert('滑动验证未通过');
                                    return false;
                                }else if(result == -1){
                                    alert('电话或邮箱不存在');
                                    return false;
                                }else{
                                    location.href = "./step2?token=" + result;
                                }
                            }
                        })
            /* 判断验证码是否正确 */
            // $.get("http://www.jcpeixun.com/ashx/api/Ischeckcode.aspx", { "code": sVcode }).done(function (d) {
            //     if (d == "0") {/*如果返回值等于0，则提示，验证码不正确，请重新输入*/
            //         $("#c_tips").attr("class", "cred").html("验证码不正确，请重新输入");
            //     } else {
            //         /* 判断帐号是否存在 */
            //         $.post("http://www.jcpeixun.com/forgotpw/IsExistUser.aspx", { 'uName': sUname }).done(function (d) {
            //             if (d != "0") {
            //                 location.href = "find_pwd2.aspx?learner_id=" + d;
            //             }
            //             else {
            //                 alert("您好，您输入的账号不存在");
            //             }
            //         });
            //     }
            // });
        }
    });


    /* 2 */
    // $("#send_email").click(function () {
    //     $.post("/emailregister/sendemail.aspx", { 'email': $("#iptemail").val(), 'url': $("#ipturl").val(), 'emailTemplate': 'findpassword' }).done(function (d) {
    //         if (d == "1") {
    //             $("#validate_aways,#ol_email").hide();
    //             $("#email_send").show();
    //         }
    //         else {
    //             alert("邮件发送失败");
    //         }
    //     });
    // });


    $("#v_aways").delegate("input[type='radio']", "click", function () {
        var $id = $(this).attr("id");
        $("#ol_" + $id).show().siblings("ol[id^='ol_']").hide();
    });

    /* 发送验证码 */
    $("#sendCode").click(function () {
        $("#sendCode").hide();
        var $cdown_tips = $("#cdown_tips");
        umobile = $.trim($("#iptmobile").val());
        var radomnumber = Radom4();
        $.post("http://www.jcpeixun.com/ashx/api/sendMCode.aspx", { mobile: umobile, content: "您的验证码为：" + radomnumber, code: radomnumber, gettype: 'getpassword' }).done(function (d) {
            if (d == "1") {
                var i = 60;
                var fn = function () {
                    $cdown_tips.html(i + "秒后才能再次发送");
                    !i && $cdown_tips.hide() && $("#sendCode").show() && clearInterval(timer);
                    i--;
                };
                timer = setInterval(fn, 1000);
                fn();
                $cdown_tips.show();
            } else if (d == "-4") {
                alert("不能频繁发验证码，请3分钟后再试");
            }
        });
    });
    //手机验证
    $("#findPwdForm2").delegate("#fp_btn_next2", "click", function () {
        var sVcode = $("#vcode").val();
        umobile = $.trim($("#iptmobile").val());
        var uid = $.trim($("#iptlearnerid").val());
        if ($trim(sVcode).length < 1 || umobile.length < 1) {
            $("#c_tips").html("您的信息输入不完整，请核实");
        } else {
            $.post("http://www.jcpeixun.com/ashx/api/checkMCode.aspx", { mobile: umobile, code: sVcode }).done(function (d) {
                if (d == "1") {
                    $.post("/forgotpw/updateMobilepass.aspx", { learner_id: uid }).done(function (d) {
                        if (d == "1") {
                            location.href = "/forgotpw/find_pwd3.aspx?learner_id=" + uid;
                        } else {
                            alert("修改手机验证失败");
                        }
                    });
                } else {
                    alert("验证码不正确");
                }
            });
        }
    });


    if ($("#email").prop("checked") == true) {
        var eid = $("#email").attr("id");
        $("#ol_" + eid).show().siblings("ol[id^='ol_']").hide();
    } else if ($("#mobile").prop("checked") == true) {
        var mid = $("#mobile").attr("id");
        $("#ol_" + mid).show().siblings("ol[id^='ol_']").hide();
    }



    /* 3 */
    $("#uNpwd,#uNpwd2").focus(function () {
        $(this).attr("class", "txt_blue1-240-25");
        $("#p1_tips").html("");
    }).blur(function () {
        $(this).attr("class", "txt_gray1-240-25");
        $("#p2_tips").html("");
    });

    $("#btn_set_pwd").click(function () {
        var unpwd = $("#uNpwd").val();
        var unpwd2 = $("#uNpwd2").val();
        var uid = $("#iptlearnerid").val();
        if ($trim(unpwd).length < 6 || $trim(unpwd).length > 20) {
            $("#uNpwd").attr("class", "txt_red1-240-25");
            $("#p1_tips").html("密码不能小于6位或大于20位");
        } else if ($trim(unpwd) != $trim(unpwd2)) {
            $("#p2_tips").html("两次输入密码不一样");
        } else {
            $.post("/forgotpw/updatepassword.aspx", { 'password': unpwd2, 'learner_id': uid }).done(function (d) {
                if (d == "1") {
                    location.href = "/forgotpw/find_pwd4.aspx";
                }
                else {
                    alert("修改密码失败");
                }
            });
        }
    });



    /* 4 */
    $("#uName").focus(function () {
        $("#uName").attr("class", "txt_blue1-240-30");
        $("#n_tips").attr("class", "cgray5").html("支持用户名/邮箱/手机号");
    });

    $("#fp_next").delegate("#fp_btn_next", "click", function () {
        var sUname = $("#uName").val();
        if (!(vUname.test(sUname) || vUemail.test(sUname) || vUmobile.test(sUname))) {
            $("#uName").attr("class", "txt_red1-240-30");
            $("#n_tips").attr("class", "cred").html("帐号格式不正确，请输入正确的帐号");
        } else {
            alert("1");
        }
    });




});