$(document).ready(function () {
    $(".add_account").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.wrap("<div class='vld-error'>")
        },
        rules: {
            "userName": {
                required: true,
                valName:true,
            },
            "phone":{
                validateSdt:true,
            },
            "password": {
                required: true,
            },
            "repassword": {
                required: true,
                equalTo: "#password",
            },
            "email": {
                required: true, 
                email: true,
            },
        },
        messages: {
            "userName": {
                required: 'Tên đăng nhập không được để trống',
            },
            "password": {
                required: "Mật khẩu không được để trống",
            },
            "repassword": {
                required: "Mật khẩu nhập lại không được để trống",
                equalTo: "Mật khẩu nhập lại không trùng khớp",
            },
            "email": {
                required: "Email không được để trống",
                email: "Email không đúng định dạng"
            },
        },
        submitHandler: function(form) {
            var modules = [];
            $("input[name='modul']:checked").each(function() {
                modules.push($(this).val());
            });
            var formData ={
                name    : $('#name').val(),
                fullname    : $('#fullname').val(),
                phone    : $('#phone').val(),
                password    : $('#password').val(),
                email       : $('#email').val(),
                modul       : modules
            };  
            // console.log(formData);
            $.ajax({
                url: '/Admin/ajax_add_account',
                type: 'POST',
                dataType: 'json',
                data: {
                  formData: formData
                 },
                success: function(res) {
                    console.log(res);
                    if (res.kq == true) {
                       window.location.href ="/admin/list_account";
                    }else{
                        alert("Tên đăng nhập đã tồn tại.");
                    }
                }            
            });
        }
    });
    $(".edit_account").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.wrap("<div class='vld-error'>")
        },
        rules: {
            "userName": {
                valName:true,
            },
            "phone":{
                validateSdt:true,
            },
            "repassword": {
                equalTo: "#password",
            },
            "email": {
                required: true,
                email: true,
            },
        },
        messages: {
            "repassword": {
                equalTo: "Mật khẩu nhập lại không trùng khớp",
            },
            "email": {
                required: "Email không được để trống",
                email: "Email không đúng định dạng"
            },
        },
        submitHandler: function(form) {
            var modules = [];
            $("input[name='modul']:checked").each(function() {
                modules.push($(this).val());
            });
            var formData ={
                id    : $('#id').val(),
                name    : $('#name').val(),
                fullname    : $('#fullname').val(),
                phone    : $('#phone').val(),
                password    : $('#password').val(),
                email       : $('#email').val(),
                modul       : modules
            };  
            $.ajax({
                url: '/Admin/ajax_edit_account',
                type: 'POST',
                dataType: 'json',
                data: {
                  formData: formData
                 },
                success: function(respon) {
                    if (respon.kq == true) {
                        alert(respon.msg);
                        window.location.href ="/admin/list_account";
                    }else{
                        alert("Cập nhật lỗi.")
                    }
                } ,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }           
            });
        }
    });
    $(".change_pass").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.wrap("<div class='vld-error'>")
        },
        rules: {
            "password_old": {
                required: true,
            },
            "password": {
                required: true,
            },
            "password_confirmation": {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            "password_old": {
                required: "Mật khẩu cũ không được để trống",
            },
            "password": {
                required: "Mật khẩu mới không được để trống",
            },
            "password_confirmation": {
                required: "Mật khẩu nhập lại không được để trống",
                equalTo: "Mật khẩu nhập lại không trùng khớp",
            },
        },
        submitHandler: function(form) {
            var formPass ={
                password_old    : $('#password_old').val(),
                password    : $('#password').val(),
            };  
            console.log(formPass);
            $.ajax({
                url: '/Admin/change_password_account',
                type: 'POST',
                dataType: 'json',
                data: {
                  formPass: formPass
                 },
                success: function(res) {
                    alert(res.msg);
                    location.reload();
                }            
            });
        }
    });
    $.validator.addMethod("valName", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9_àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ ]*$/i.test(value);
    }, "Tên đăng nhập không được chứa ký tự đặc biệt");
    $.validator.addMethod("validateSdt", function(value, element) {
        if (this.optional(element) || /^\d{10}$/.test(value)) {
            return true;
        } else {
            return false;
        };
    },"Nhập sai định dạng số điện thoại, phải đủ 10 số");

});