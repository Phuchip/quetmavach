// slide
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("gallery-slide");
    var dots = document.getElementsByClassName("demo");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

// click button add cart
$('.btn-add-cart').click(function(){
    var input = $('.input-quantity');
    var number = input.val();
    var id = $('#id_product').val();
    if(number < 1){
        alert ('Vui lòng nhập số lượng lớn tối thiểu là 1');
        input.val('1');
    }else{
        $.ajax({
            url : '/site/actionCart',
            type : 'POST',
            data : {
                id : id,
                quantity : number,
                action : 'add',
            },
            dataType : 'JSON',
            beforeSend : function(){
                $('.btn-add-cart i').addClass('icon-load');
            },
            success : function(data){
                if(data.result == false){
                    $('.item-quantity').after("<label class='error-form'>"+data.mes+"</label>");
                }else{
                    $('.error').remove();
                    alert(data.mes);
                    input.val('1');
                    $('.btn-add-cart').attr("disabled", true);
                    $('.btn-add-cart').addClass('disabled');
                }
            },
            complete: function() {
                $('.btn-add-cart i').removeClass('icon-load');
            },
        });
    }
    
});
// click order now
$('.btn-order-now').click(function(){
    var id = $('#id_product').val();
    var number = 1;
    $.ajax({
        url : '/site/actionCart',
        type : 'POST',
        data : {
            id : id,
            quantity : number,
            action : 'add',
        },
        dataType : 'JSON',
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                window.location.href = './gio-hang.html';
            }
        },
    });
});
// Comment ajax
$('.send-comment').click(function(){
    SendComment($(this));
    $("input[name=parent]").val('0');
});
function SendComment(reply) {
    var parent = reply.parents('.form-footer');
    var id_parent = $("input[name=parent]").val();
    var name = parent.find('.comment-name').val();
    var email = parent.find('.comment-email').val();
    var phone = parent.find('.comment-phone').val();
    var id_product = $("input[name=id_product]").val();
    if(id_parent != 0){
        var comment = $('.input-comment-reply').val();
    }else{
        var comment = $('.input-comment').val();
    }
    if(comment == ''){
        alert ('Vui lòng điền nội dung bình luận');
        $('.input-comment').focus();
        return;
    }
    if(name == ''){
        $(".error_name").remove();
        parent.find('.comment-name').after("<label class='error-form error_name'>Vui lòng nhập họ tên</label>");
    }
    if(email != ''){
        $(".error_email").remove();
        if( !validateEmail(email)){
            parent.find('.comment-email').after("<label class='error-form error_email'>Sai định dạng email</label>");
        }
    }else{
        $(".error_email").remove();
        parent.find('.comment-email').after("<label class='error-form error_email'>Vui lòng nhập email</label>");
    }
    if(phone != ''){
        $(".error_phone").remove();
        if(!validatePhone(phone)){
            parent.find('.comment-phone').after("<label class='error-form error_phone'>Sai định dạng số điện thoại</label>");
        }
    }else{
        $(".error_phone").remove();
        parent.find('.comment-phone').after("<label class='error-form error_phone'>Vui lòng nhập số điện thoại</label>");
    }
    $.ajax({
        type: "POST",
        url: "/site/addComment",
        data: {
            id_product : id_product,
            id_parent : id_parent,
            name : name,
            email : email,
            phone : phone,
            comment : comment,
        },
        dataType: "json",
        success : function(data){
            if(id_parent == 0){
                var html = `<div class="show-comment">
                    <div class="info-comment">
                            <div class="user">
                                <img class="lazyload" src="/images/loading.gif" data-src="/pictures/user/no-avatar.png" alt="avt user">
                                <p class="name-user">Phúc Híp</p>
                                <span class="pending">(Bình luận của bạn đang chờ được duyệt)</span>
                            </div>
                            <div class="info-comment-detail">
                                <p class="name-user db-375">`+name+`</p>
                                <div class="date-time-comment">
                                    <p class="date-comment">`+data.date+` ,`+data.day+` </p>
                                    <p class="time-comment">`+data.time+`</p>
                                </div>
                                <div class="comment-content">
                                    <p>`+comment+`</p>
                                </div>
                                <a href="javascript:void(0)" class="reply-comment" id="`+data.id+`">Trả lời</a>
                            </div>
                        </div>
                    </div>`;
                if($('.show-comment').length > 0){
                    $('.show-comment').before(html);
                }else{
                    $('.list-comment').append(html);
                }
            }else{
                $('#'+id_parent).after(`<div class="info-reply-comment">
                                    <i class="icon-reply"></i>
                                    <div class="user-reply">
                                        <img class="lazyload" src="/images/loading.gif" data-src="/pictures/user/timviec365.png" alt="avt user reply">
                                    </div>
                                    <div class="info-comment-reply">
                                        <div class="name-user-reply"><p>`+name+` <span class="pending">(Bình luận của bạn đang chờ được duyệt)</span></p></div>
                                        <div class="reply-content">
                                            <p>`+comment+`</p>
                                        </div>
                                        <div class="date-time-comment">
                                            <p class="date-comment">`+data.date+` ,`+data.day+` </p>
                                            <p class="time-comment">`+data.time+`</p>
                                        </div>
                                    </div>
                                </div>`);
            }
            $("input[name=parent]").val('0');
            $('.input-comment').val('');
            $('.comment-name').val('');
            $('.comment-phone').val('');
            $('.comment-email').val('');
        },
        complete: function() {
            $('.form-reply').remove();
        },
    });
}
function validatePhone($phone){
    var phoneReg = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
    return phoneReg.test($phone);
}
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}
function showForm(e) {
    var value = $(e).parents().find('.input-comment-reply').val();
    if(value === ''){
        alert ('Vui lòng điền nội dung bình luận');
        return;
    }
    SendComment($(e));
}
// reply comment
$(document).on('click', '.reply-comment', function(event){
    var id_parent = $(this).attr("id");
    $("input[name=parent]").val(id_parent);
    var parent = $(this).parents('.show-comment');
    var pr = parent.find('.form-reply');
    if (pr.length > 0) {
        $('.form-reply').remove();
    }else{
        $('.form-reply').remove();
        parent.append(`<div class="form-reply">
                            <form onsubmit="return false" class="form-comment">
                                <textarea name="comment" cols="30" rows="10" class="input-comment-reply" placeholder="Mời bạn để lại bình luận . . ."></textarea>
                                <div class="form-footer">
                                    <div class="form-info">
                                        <div class="input-form cmt-name">
                                            <input class="comment-name " type="text" name="name" placeholder="Nhập tên">
                                        </div>
                                        <div class="input-form cmt-email">
                                            <input class="comment-email" type="text" name="email" placeholder="Nhập email">
                                        </div>
                                        <div class="input-form cmt-phone">
                                            <input class="comment-phone" type="text" name="phone" placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                    <div class="comment-submit">
                                        <button class="btn-comment send-reply" onclick="showForm(this)">Gửi bình luận</button>
                                    </div>
                                </div>
                            </form>
                        </div>`);
        $('.input-comment-reply').focus();
    }
});