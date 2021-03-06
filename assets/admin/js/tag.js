$(document).ready(function () {
    $('.check-show-tag').click(function() {
        var id = $(this).val();
        var action;
        if($(this).is(':checked')){
            action = 'show';
        }else{
            action = 'hidden';
        }
        $.ajax({
            url: '/Admin/index_tag',
            type: 'POST',
            dataType: 'json',
            data: {id: id,action : action},
            success: function(res) {
                console.log(res);
                if (res.kq == true) {
                    location.reload();
                }
            }    
        });
    });
    $('.check-show-coment').click(function() {
        var id = $(this).val();
        var action;
        if($(this).is(':checked')){
            action = 'show';
        }else{
            action = 'hidden';
        }
        $.ajax({
            url: '/Admin/show_comment',
            type: 'POST',
            dataType: 'json',
            data: {id: id,action : action},
            success: function(res) {
                console.log(res);
                if (res.kq == true) {
                    location.reload();
                }
            }   
        })
    });
    $('#reply_cmt').click(function() {
        var id_pro = $(this).val();
        var id_cmt = $("#id_cmt").val();
        var comment = CKEDITOR.instances.comment.getData();
        $.ajax({
            url: '/Admin/reply_comment',
            type: 'POST',
            dataType: 'json',
            data: {id_pro: id_pro,comment : comment,id_cmt: id_cmt},
            success: function(res) {
                console.log(res);
                if (res.kq == true) {
                    location.reload();
                }
            }   
        });
        return false;
    });
    $('.status_order').change(function(){
        var status = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "/Admin/update_status_order",
            data: {
                status: status,
                id: id,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                if(data.kq == true){
                    location.reload();
                }
            }
        });
    });
    $("#add_edit_voucher").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.wrap("<div class='vld-error'>")
        },
        rules: {
            "code": {
                required: true,
            },
            "price_discount": {
                required: true,
            },
            "type": {
                required: true,
            },
            "start_day": {
                required: true,
            },
            "end_day": {
                required: true,
            },
        },
        messages: {
            "code": {
                required: 'M?? kh??ng ???????c ????? tr???ng',
            },
            "price_discount": {
                required: 'Gi???m gi?? kh??ng ???????c ????? tr???ng',
            },
            "type": {
                required: 'Ch??a ch???n lo???i gi???m gi??',
            },
            "start_day": {
                required: 'Ch??a ch???n ng??y b???t ?????u',
            },
            "end_day": {
                required: 'Ch??a ch???n ng??y k???t th??c',
            },
        },
        submitHandler: function(form) {
            if ($("#type").val() == 2) {
                if ($("#price_discount").val() > 100) {
                    alert("Kh??ng ???????c nh???p qu?? 100%."); return false;
                }
            }
            $.ajax({
                url: '/Admin/ajax_add_edit_voucher',
                type: 'POST',
                dataType: 'json',
                data: {
                  id: $("#id").val(),
                  code: $("#code").val(),
                  price_discount: $("#price_discount").val(),
                  type: $("#type").val(),
                  start_day: $("#start_day").val(),
                  end_day: $("#end_day").val(),
                  status: $("#status").val(),
                  submit: $("#submit").val(),
                 },
                success: function(res) {
                    console.log(res);
                    if (res.kq == true) {
                        alert(res.msg);
                       window.location.href ="/admin/list_voucher";
                    }else{
                        alert(res.msg);
                    }
                }            
            });
        }
    });
    
    $("#add_edit_tags").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.wrap("<div class='vld-error'>")
        },
        rules: {
            "name": {
                required: true,
            },
            "title_suggest": {
                required: true,
            },
            "title": {
                required: true,
            },
            "description": {
                required: true,
            },
            "keyword": {
                required: true,
            },
        },
        messages: {
            "name": {
                required: 'T??n tag kh??ng ???????c ????? tr???ng',
            },
            "title_suggest": {
                required: 'Ti??u ????? g???i ?? kh??ng ???????c ????? tr???ng',
            },
            "title": {
                required: 'Ti??u ????? seo kh??ng ???????c ????? tr???ng',
            },
            "description": {
                required: 'M?? t??? kh??ng ???????c ????? tr???ng',
            },
            "keyword": {
                required: 'Keyword kh??ng ???????c ????? tr???ng',
            },
        },
        submitHandler: function(form) {
            var content = CKEDITOR.instances.content.getData();
            var content_suggest = CKEDITOR.instances.content_suggest.getData();
            $.ajax({
                url: '/Admin/ajax_add_edit_tags',
                type: 'POST',
                dataType: 'json',
                data: {
                  id: $("#id").val(),
                  name: $("#name").val(),
                  status: $("#status").val(),
                  show_post: $("#show_post").val(),
                  content: content,
                  content_suggest: content_suggest,
                  title_suggest: $("#title_suggest").val(),
                  title: $("#title").val(),
                  description: $("#description").val(),
                  keyword: $("#keyword").val(),
                  submit: $("#submit").val(),
                 },
                success: function(res) {
                    console.log(res);
                    if (res.kq == true) {
                        alert(res.msg);
                       window.location.href ="/admin/list_tags";
                    }else{
                        alert(res.msg);
                    }
                }            
            });
        }
    });

});