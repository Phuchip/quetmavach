//list filter
$('.btn-filter-price').click(function(event) {
	var url = '?action=filter';
	var price = '';
	const price_first = $('.price-first').val().replace(/\D/g, "");
    const price_second = $('.price-second').val().replace(/\D/g, "");
	if (price_first == '') {
		price_first = 0;
	}
	if (price_second == '') {
		alert('Vui lòng nhập số tiền để lọc');
		return false;
	}
    url += `&min=${price_first}&max=${price_second}`;
    var link = document.URL.split('?');
    link = link[0];
    return window.location.href = link+url;
});
$('button-filter').click(function(event) {
	/* Act on the event */
});
$('.page-li').click(function(){
    var page = $(this).val();
    getURL(page);
});
$('.category input').click(function(event) {
	getURL();
});
$('.ray-types input').click(function(event) {
	getURL();
});
$('.item-style input').click(function(event) {
	getURL();
});
$('.connector input').click(function(event) {
	getURL();
});
$('.filter-option').on('change', function (e) {
    getURL();
});
$('.btn-sort').click(function(event) {
	if($(this).hasClass('active')){
        $('.btn-sort').removeClass('active');
    }else{
        $('.btn-sort').removeClass('active');
        $(this).addClass('active');
    }
	getURL();
});
// Get URL
function getURL(page){
    var url = '?action=filter';
    var link = document.URL.split('?');
    link = link[0];
    const price_first = $('.price-first').val().replace(/\D/g, "");
    const price_second = $('.price-second').val().replace(/\D/g, "");
    if ($('.btn-filter-price').hasClass('active')) {
    	url += `&min=${price_first}&max=${price_second}`;
    }
    var sort = '';
    $('.btn-sort').each(function(index){
        elm = $(this);
        if(elm.hasClass('active')){
            url += `&sort=${$(this).val()}`;
        }
    });
    var cate = '';
    var ray_type ='';
	var connect = '';
    var item_style ='';
    if (width > 1200) {
    	$('.category').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            cate += $(this).val()+'%2C';
	        }
	    });
	    $('.ray-types').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            ray_type += $(this).val()+'%2C';
	        }
	    });
        $('.item-style').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            item_style += $(this).val()+'%2C';
	        }
	    });
	    $('.connector').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            connect += $(this).val()+'%2C';
	        }
	    });
    
    }else if (width > 665) {
    	$('.category').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            cate += $(this).val()+'%2C';
	        }
	    });
	    $('.ray-types').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            ray_type += $(this).val()+'%2C';
	        }
	    });
        $('.item-style').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            item_style += $(this).val()+'%2C';
	        }
	    });
	    $('.connector').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            connect += $(this).val()+'%2C';
	        }
	    });
    }else{
    	$('.category').find('input[type=checkbox].ft-mb').each(function(index){
	        if ($(this).is(':checked')) {
	            cate += $(this).val()+'%2C';
	        }
	    });
	    $('.ray-types').find('input[type=checkbox].ft-mb').each(function(index){
	        if ($(this).is(':checked')) {
	            ray_type += $(this).val()+'%2C';
	        }
    	});
        $('.item-style').find('input[type=checkbox].ft-mb').each(function(index){
	        if ($(this).is(':checked')) {
	            item_style += $(this).val()+'%2C';
	        }
	    });
	    $('.connector').find('input[type=checkbox].ft-mb').each(function(index){
	        if ($(this).is(':checked')) {
	            connect += $(this).val()+'%2C';
	        }
	    });
    }
    if(cate != ''){
        cate = cate.slice(0,-3);
        url += `&cate=${cate}`;
    }
    
    if(ray_type != ''){
        ray_type = ray_type.slice(0,-3);
        url += `&ray_type=${ray_type}`;
    }
    
    if(item_style != ''){
        item_style = item_style.slice(0,-3);
        url += `&style=${item_style}`;
    }
    
    if(connect != ''){
        connect = connect.slice(0,-3);
        url += `&connect=${connect}`;
    }
    var option = $('.filter-option option:selected').val();
    if (option != 0) {
    	url +=`&filter=${option}`;
    }
    if (page != undefined) {
    	url += `&page=${page}`;
    }
    return window.location.href = link+url;
}