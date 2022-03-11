// validate input number product
$('.input-quantity').bind("input change", function(){
    var num = $(this).val();
    var id = $(this).attr('data-id');
    if(num < 1){
        alert ('Vui lòng nhập giá trị lớn hơn 0');
        $(this).val('1');
    }else{
        $.ajax({
            url : '/site/actionCart',
            type : 'POST',
            data : {
                id : id,
                quantity : num,
                action : 'update',
            },
            dataType : 'JSON',
            success : function(data){
                $('.total-cart').text(data.total+'đ');
                $('.into-cart').text(data.into+'đ');
                $('.total-item'+id).text(data.item+'đ');
            },
        });
    }
});
// checkbox 
$('#check-all').click(function(){
    if(this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
// delete all
$('.delete-all').click(function(event){
    var list_id = '';
    var action = '';
    $('.item-checkbox').each(function(index, value) {
        if ($(this).is(':checked')) {
        	var id = $(this).attr('data-id');
            list_id += ','+id;
            $('.item-cart-'+id).remove();
        }
    });
    if(list_id == ''){
    	alert('Vui lòng chọn sản phẩm cần xóa');
    	return false;
    }
    if($('.table-cart').find('.list-item-cart').length == 0){
    	$('.cart-info-head').after(`<li class="no-item-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</li>`);
    	$('.cart-payment a').attr("href", "javscript:void(0)");
    	action = 'delete_all';
    }else{
    	action = 'delete_list';
    }
    list_id = list_id.substring(1);
    $.ajax({
        url : '/site/actionCart',
        type : 'POST',
        data : {
        	id : list_id,
            action : action,
        },
       	dataType : 'JSON',
        success : function(data){
            $('.total-cart').text(data.total+'đ');
            $('.into-cart').text(data.into+'đ');
        },
    });

});
// delete product in cart
$('.delete-item').click(function(event){
    var action = '';
    var id = $(this).attr('data-id');
    $('.item-cart-'+id).remove();
    if($('.table-cart').find('.list-item-cart').length == 0){
    	$('.cart-info-head').after(`<li class="no-item-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</li>`);
    	$('.cart-payment a').attr("href", "javscript:void(0)");
    	action = 'delete_all';
    }else{
    	action = 'delete';
    }
    $.ajax({
        url : '/site/actionCart',
        type : 'POST',
        data : {
            id : id,
            action : action,
        },
        dataType : 'JSON',
        success : function(data){
            $('.total-cart').text(data.total+'đ');
            $('.into-cart').text(data.into+'đ');
        },
    });
});

// delete product in cart mobile
$('.delete-item-m').click(function(event){
    var action = '';
    var id = $(this).attr('data-id');
    $('.item-cart-m-'+id).remove();
    if($('.cart-info-m').find('.item-cart').length == 0){
        $('.cart-info-m').append(`<li class="no-item-cart">Bạn đang không có sản phẩm nào trong giỏ hàng</li>`);
        $('.cart-payment a').attr("href", "javscript:void(0)");
        action = 'delete_all';
    }else{
        action = 'delete';
    }
    $.ajax({
        url : '/site/actionCart',
        type : 'POST',
        data : {
            id : id,
            action : action,
        },
        dataType : 'JSON',
        success : function(data){
            $('.total-cart').text(data.total+'đ');
            $('.into-cart').text(data.into+'đ');
        },
    });
});
// form discount
$('.input-code').submit(function( event ) {
    var value = $(this).find('input').val();
    if (value == '') {
        alert('Vui lòng nhập Mã giảm giá !');
        return false;
    }
    $.ajax({
        url : '/site/discount',
        type : 'POST',
        data : {
            discount : value,
        },
        dataType : 'JSON',
        success : function(data){
            if (data.result == true) {
                alert(data.mes);
                $('.into-cart').text(data.total+'đ');
                $('.discount-code').text('-'+data.discount+'đ');
            } else {
                alert(data.mes);
            }
            
        },
    });
});