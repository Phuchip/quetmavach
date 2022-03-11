$('#button-navbar-menu').click(function(event) {
	$('#navbar-menu').toggleClass('show');
});
$('.btn-filter').click(function(event) {
	$(this).toggleClass('filter-show');
	$('.hf-left-body').toggleClass('show');
});
$("body").click(function (event) {
	var navigation = $(event.target).parents(".navbar").length;
	if(!navigation) {
		$(".navbar-collapse").removeClass("show");
	}
});
// dropdown search
function searchdropdown(){
    document.getElementById("suggestion-box").classList.add(("show"))
}
$('.search-box').keyup(function(event) {
	var input = $(this).val();
	if(input == 0){
		$('#suggestion-box').removeClass('show');
	}
});
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('#search-box dropdown show')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
// modal
$('.item-contact').click(function(event) {
	openModal('#form-modal');
});
$('.btn-modal-confirm').click(function(event) {
	removeModal('#form-modal');
	openModal('#confirm-modal');
});
$('.btn-modal-access').click(function(event) {
	removeModal('#confirm-modal');
});
$('.btn-modal-close').click(function(event) {
	removeModal('#form-modal');
});
function openModal(id) {
	console.log(id);
	$(id).addClass('show');
	$('body').addClass('modal-fade');
}
function removeModal(id) {
	$(id).removeClass('show');
	$('body').removeClass('modal-fade');
}
// add cart
$('.add-to-cart').click(function(event) {
	var id = $(this).attr('data-id');
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
        beforeSend : function(){
            $(this).html('<i class="icon-load"></i>');
        },
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                alert(data.mes);
            }
        },
        complete: function() {
            $(this).html('<i class="icon-cart"></i>');
        },
    });
});
// plus minus number
$('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
});
$('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
});
// redirect search
$('.form-seach-submit').submit(function(){
    var value = $(this).find('.search-box').val();
    value = value.toLowerCase();
    $.ajax({
        url : '/site/redirect_search',
        type : 'POST',
        data : {key : value},
        dataType : 'JSON',
        success : function(data){
            if(data.result == true){
                window.location.href = data.link;
            }else{
                window.location.href = data.link;
            }
        },
    });
});
width = $(window).width();
// filter ajax
$('.category input').click(function(){
    var array = '';
    if (width > 1200) {
    	$('.category').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    } else {
    	$('.category').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    }
    array = array.slice(0,-1);
    $.ajax({
        url : '/site/filter_ajax',
        type : 'POST',
        data : {
            cate : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.hf-right-content').html('<div class="no-found"><img src="../images/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            if (data.result == true) {
            	$('.no-found').remove();
            	$('.hf-right-content').html(data.output);
            } else {
            	$('.hf-title').after(data.output);
            	$('.hf-right-content').html('');
            }
        }
    });
});
$('.ray-types input').click(function(){
    var array = '';
    if (width > 1200) {
    	$('.ray-types').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    } else {
    	$('.ray-types').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    }
    array = array.slice(0,-1);
    $.ajax({
        url : '/site/filter_ajax',
        type : 'POST',
        data : {
            ray_type : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.hf-right-content').html('<div class="no-found"><img src="../images/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            if (data.result == true) {
            	$('.no-found').remove();
            	$('.hf-right-content').html(data.output);
            } else {
            	$('.hf-title').after(data.output);
            	$('.hf-right-content').html('');
            }
        }
    });
});
$('.item-style input').click(function(){
    var array = '';
    if (width > 1200) {
    	$('.item-style').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    } else {
    	$('.item-style').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    }
    array = array.slice(0,-1);
    $.ajax({
        url : '/site/filter_ajax',
        type : 'POST',
        data : {
            style : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.hf-right-content').html('<div class="no-found"><img src="../images/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            if (data.result == true) {
            	$('.no-found').remove();
            	$('.hf-right-content').html(data.output);
            } else {
            	$('.hf-title').after(data.output);
            	$('.hf-right-content').html('');
            }
        }
    });
});
$('.connector input').click(function(){
    var array = '';
    if (width > 1200) {
    	$('.connector').find('input[type=checkbox].ft-pc').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    } else {
    	$('.connector').find('input[type=checkbox].ft-tablet').each(function(index){
	        if ($(this).is(':checked')) {
	            value = $(this).val();
	            array += value+',';
	        }
	    });
    }
    array = array.slice(0,-1);
    $.ajax({
        url : '/site/filter_ajax',
        type : 'POST',
        data : {
            connect : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.hf-right-content').html('<div class="no-found"><img src="../images/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            if (data.result == true) {
            	$('.no-found').remove();
            	$('.hf-right-content').html(data.output);
            } else {
            	$('.hf-title').after(data.output);
            	$('.hf-right-content').html('');
            }
        }
    });
});
// scroll top
var scroll = document.getElementById("scroll_top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
	scrollFunction()
};

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		scroll.style.display = "block";
	} else {
		scroll.style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}
// end scroll top