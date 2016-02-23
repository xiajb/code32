                $("#xuanxiu").click(function(){
                    $('#xuanxiu').addClass("active");
                    $('#bixiu').removeClass("active");
                    $('#jineng').removeClass("active");
                    $('#tab1').css('display', 'block');
                    $('#tab2').css('display', 'none');
                    $('#tab3').css('display', 'none');
                });  
                $("#bixiu").click(function(){
                    $('#xuanxiu').removeClass("active");
                    $('#bixiu').addClass("active");
                    $('#jineng').removeClass("active");
                    $('#tab1').css('display', 'none');
                    $('#tab2').css('display', 'block');
                    $('#tab3').css('display', 'none');
                });  
                $("#jineng").click(function(){
                    $('#xuanxiu').removeClass("active");
                    $('#bixiu').removeClass("active");
                    $('#jineng').addClass("active");
                    $('#tab1').css('display', 'none');
                    $('#tab2').css('display', 'none');
                    $('#tab3').css('display', 'block');                  
                }); 
var xuanxiu_uploader = new plupload.Uploader({ //创建实例的构造方法 
    runtimes: 'html5,flash,silverlight,html4',
    //上传插件初始化选用那种方式的优先级顺序 
    browse_button: 'xuanxiu-btn',
    // 上传按钮 
    url: "../upload_pic",
    //远程上传地址 
    flash_swf_url: 'plupload/Moxie.swf',
    //flash文件地址 
    silverlight_xap_url: 'plupload/Moxie.xap',
    //silverlight文件地址 
    filters: {
        max_file_size: '500kb',
        //最大上传文件大小（格式100b, 10kb, 10mb, 1gb） 
        mime_types: [ //允许文件上传类型 
            {
                title: "files",
                extensions: "jpg,png,gif"
            }
        ]
    },
    multi_selection: false,
    //true:ctrl多文件上传, false 单文件上传 
    init: {
        FilesAdded: function(up, files) { //文件上传前 
            if ($("#ul_pics").children("li").length > 0) {
                alert("您上传的图片太多了！");
                xuanxiu_uploader.destroy();
            } else {
                var li = '';
                plupload.each(files,
                    function(file) { //遍历文件 
                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                    });
                $("#ul_pics").append(li);
                xuanxiu_uploader.start();
            }
        },
        UploadProgress: function(up, file) { //上传中，显示进度条 
            $("#" + file.id).find('.bar').css({
                "width": file.percent + "%"
            }).find(".percent").text(file.percent + "%");
        },
        FileUploaded: function(up, file, info) { //文件上传成功的时候触发 
            var data = JSON.parse(info.response);
            $("#" + file.id).html("<div class='img' ><img  style='width:220px;' src='../../../" + data.pic + "'/></div><p style='display:none;' id='picname'>" + data.pic + "</p>");
            document.getElementById('xuanxiu-pic').value=data.pic;
        },
        Error: function(up, err) { //上传出错的时候触发 
            alert(err.message);
        }
    }
});

xuanxiu_uploader.init();
$("#xuanxiuButton").click(function() {
    var value = {
        "name": $("#xuanxiu-name").val(),
        "title": $("#xuanxiu-title").val(),
        "detail": $("#xuanxiu-info").val(),
        "img": $("#xuanxiu-pic").val(),
    }
    $.ajax({
        type: 'POST',
        url: "../center/elective_add",
        data: value,
        success: function(result) {
            if (result == 1) {
                alert('提交成功！请等待审核！');
            }
        }
    });
});

var jineng_uploader = new plupload.Uploader({ //创建实例的构造方法 
    runtimes: 'html5,flash,silverlight,html4',
    //上传插件初始化选用那种方式的优先级顺序 
    browse_button: 'jineng-btn',
    // 上传按钮 
    url: "../upload_pic",
    //远程上传地址 
    flash_swf_url: 'plupload/Moxie.swf',
    //flash文件地址 
    silverlight_xap_url: 'plupload/Moxie.xap',
    //silverlight文件地址 
    filters: {
        max_file_size: '500kb',
        //最大上传文件大小（格式100b, 10kb, 10mb, 1gb） 
        mime_types: [ //允许文件上传类型 
            {
                title: "files",
                extensions: "jpg,png,gif"
            }
        ]
    },
    multi_selection: false,
    //true:ctrl多文件上传, false 单文件上传 
    init: {
        FilesAdded: function(up, files) { //文件上传前 
            if ($("#ul_pics").children("li").length > 0) {
                alert("您上传的图片太多了！");
                jineng_uploader.destroy();
            } else {
                var li = '';
                plupload.each(files,
                    function(file) { //遍历文件 
                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                    });
                $("#ul_pics").append(li);
                jineng_uploader.start();
            }
        },
        UploadProgress: function(up, file) { //上传中，显示进度条 
            $("#" + file.id).find('.bar').css({
                "width": file.percent + "%"
            }).find(".percent").text(file.percent + "%");
        },
        FileUploaded: function(up, file, info) { //文件上传成功的时候触发 
            var data = JSON.parse(info.response);
            $("#" + file.id).html("<div class='img' ><img  style='width:220px;' src='../../../" + data.pic + "'/></div><p style='display:none;' id='picname'>" + data.pic + "</p>");
            document.getElementById('jineng-pic').value=data.pic;
        },
        Error: function(up, err) { //上传出错的时候触发 
            alert(err.message);
        }
    }
});

jineng_uploader.init();
$("#jinengButton").click(function() {
    var value = {
        "name": $("#jineng-name").val(),
        "title": $("#jineng-title").val(),
        "detail": $("#jineng-info").val(),
        "img": $("#jineng-pic").val(),
    }
    $.ajax({
        type: 'POST',
        url: "../center/skill_add",
        data: value,
        success: function(result) {
            if (result == 1) {
                alert('提交成功！请等待审核！');
            }
        }
    });
});

var bixiu_uploader = new plupload.Uploader({ //创建实例的构造方法 
    runtimes: 'html5,flash,silverlight,html4',
    //上传插件初始化选用那种方式的优先级顺序 
    browse_button: 'bixiu-btn',
    // 上传按钮 
    url: "../upload_pic",
    //远程上传地址 
    flash_swf_url: 'plupload/Moxie.swf',
    //flash文件地址 
    silverlight_xap_url: 'plupload/Moxie.xap',
    //silverlight文件地址 
    filters: {
        max_file_size: '500kb',
        //最大上传文件大小（格式100b, 10kb, 10mb, 1gb） 
        mime_types: [ //允许文件上传类型 
            {
                title: "files",
                extensions: "jpg,png,gif"
            }
        ]
    },
    multi_selection: false,
    //true:ctrl多文件上传, false 单文件上传 
    init: {
        FilesAdded: function(up, files) { //文件上传前 
            if ($("#ul_pics").children("li").length > 0) {
                alert("您上传的图片太多了！");
                bixiu_uploader.destroy();
            } else {
                var li = '';
                plupload.each(files,
                    function(file) { //遍历文件 
                        li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                    });
                $("#ul_pics").append(li);
                bixiu_uploader.start();
            }
        },
        UploadProgress: function(up, file) { //上传中，显示进度条 
            $("#" + file.id).find('.bar').css({
                "width": file.percent + "%"
            }).find(".percent").text(file.percent + "%");
        },
        FileUploaded: function(up, file, info) { //文件上传成功的时候触发 
            var data = JSON.parse(info.response);
            $("#" + file.id).html("<div class='img' ><img  style='width:220px;' src='../../../" + data.pic + "'/></div><p style='display:none;' id='picname'>" + data.pic + "</p>");
            document.getElementById('bixiu-pic').value=data.pic;
        },
        Error: function(up, err) { //上传出错的时候触发 
            alert(err.message);
        }
    }
});

bixiu_uploader.init();
$("#bixiuButton").click(function() {
    var value = {
        "stage": $("#stage").val(),
        "grade": $("#grade").val(),
        "subject": $("#subject").val(),
        "title":$("#bixiu-title").val(),
        "img": $("#bixiu-pic").val(),
        "info":$("#bixiu-info").val()
    }
    $.ajax({
        type: 'POST',
        url: "../center/required_add",
        data: value,
        success: function(result) {
            if (result == 1) {
                alert('提交成功！请等待审核！');
            }
        }
    });
});