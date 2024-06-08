$(document).ready(function(){

/*$('.search-input').focus(function(){
    $('.search-result').slideDown();
});

$('.search-input').blur(function(){ 
    $('.search-result').slideUp();
});
$('body').not('.search-result').on("click", function () {
    $('.search-result').slideUp();
    //event.stopPropagation();
});*/

    $('.review-slider').bxSlider({
        auto: true,
        slideWidth: 475, 
        pager: false
    });

jQuery('.search-result').click(function(event){
    event.stopPropagation();
});

$('li.user-nav > a, li.cart-nav > a').on('click', function(){
    $('.search-result').slideUp();
});

$(".search-input").on('click', function (event) {
    $('li.cart-nav .checkout-cart, li.user-nav #login-popup').slideUp();
});

(function() {

    function addSeperator(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    function rangeInputChangeEventHandler(e){
        var rangeGroup = $(this).attr('name'),
            minBtn = $(this).parent().children('.min'),
            maxBtn = $(this).parent().children('.max'),
            range_min = $(this).parent().children('.range_min'),
            range_max = $(this).parent().children('.range_max'),
            minVal = parseInt($(minBtn).val()),
            maxVal = parseInt($(maxBtn).val()),
            origin = $(this).attr('class');

        if(origin === 'min' && minVal > maxVal-5){
            $(minBtn).val(maxVal-5);
        }
        var minVal = parseInt($(minBtn).val());
        $(range_min).children('input').val(addSeperator(minVal*1));
        filterProductListByMinPrice(minVal);

        if(origin === 'max' && maxVal-5 < minVal){
            $(maxBtn).val(5+ minVal);
        }
        var maxVal = parseInt($(maxBtn).val());
        $(range_max).children('input').val(maxVal*1);
        filterProductListByMaxPrice(maxVal);
    }

    $('input[type="range"]').on( 'input', rangeInputChangeEventHandler);

 
})();

$('.available-toolTip i').on('click', function(){
    $('.available-note').removeClass('active');
    $(this).next('.available-note').addClass('active');
});

$(document).mouseup(function(e) {
    var container = $(".available-toolTip");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        //container.hide();
        $('.available-note').removeClass('active');
    }
});

/*$('.cart, .cart-item').on('click', function(){
    $(this).parents('.cart-nav').children('.checkout-cart').toggleClass('active');
});*/


$('.form-tabs a').on('click', function(){
    $('.form-tabs a').removeClass('active');
    $(this).addClass('active');
});

$('a.delivery-btn').on('click', function(){
    $('.delivery-tab').show();
    $('.collect-tab').hide();
})
$('a.collect-btn').on('click', function(){
    $('.delivery-tab').hide();
    $('.collect-tab').show();
});

$("#shipping-same-input").click(function() {
    if($(this).is(":checked")) {
        $(".shipping-same").hide(300);
    } else {
        $(".shipping-same").show(200);
    }
});

$('.brand-name').on('click', function(){
    $(this).toggleClass('active');
});


setTimeout(function() {
    $("input[name='email'], input[name='password']").each(function (i, element) {
        var el = $(this),
            autofilled = (el.is("*:-webkit-autofill")) ? el.next('span').addClass('freeze') : false;
    }); 
}, 100);

setTimeout(function() {
    $("input[name='email'], input[name='password']").each(function (i, element) {
        var el = $(this),
            autofilled = (el.is("*:-webkit-autofill")) ? el.next('label').click() : false;
    }); 
}, 100);

var formFields = $('.input-wrap');
  formFields.each(function() {
    var field = $(this);
    var input = field.find('input');
    var label = field.find('span.floating-label');
    
    function checkInput() {
      var valueLength = input.val().length;
      
      if (valueLength > 0 ) {
        label.addClass('freeze')
      } else {
            label.removeClass('freeze')
      }
    }
        $('#radioBtn3, #shipping-same-input').on('click', function(){
            checkInput();
            });

     

    input.change(function() {
      checkInput()
    })
  });

  

  $('.calander-icon').click(function() {
    $(this).parent(".fieldParent").find('.datepicker').focus();
  });

// hire accordian
var acc = document.getElementsByClassName("hire-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

    var alterClass = function() {
      var ww = document.body.clientWidth;
      if (ww < 575.98) {
        $('.Hire-box').addClass('hireAccordian-wrap');
      } else if (ww >= 575.99) {
        $('.Hire-box').removeClass('hireAccordian-wrap');
      };
    };
    $(window).resize(function(){
      alterClass();
    });
    alterClass();
	
	
	$('.user-nav a, .cart-nav a').click(function(event){
		$('#login-popup, #cart-list').slideUp();	
		$(this).next('#login-popup:hidden, #cart-list:hidden').slideDown();
		event.stopPropagation();
	});
	$('body').not('#login-popup, #cart-list').on("click", function () {
		$('#login-popup, #cart-list').slideUp();
		//event.stopPropagation();
	});
	jQuery('#login-popup, #cart-list').click(function(event){
		event.stopPropagation();
	});
    
    $('.mobile-nav a.nav-link.btn.btn-black').on('click', function(){
        $(this).toggleClass('bottom-arrow');       
    });

    $('.mobile-nav .user-nav a.nav-link.btn.btn-black').on('click', function(){    
        $('.mobile-nav .cart-nav a.nav-link.btn.btn-black').removeClass('bottom-arrow');
       });
       
       $('.mobile-nav .cart-nav a.nav-link.btn.btn-black').on('click', function(){
        $('.mobile-nav .user-nav a.nav-link.btn.btn-black').removeClass('bottom-arrow');
       });
       
       if (navigator.userAgent.indexOf('Mac OS X') != -1) {
        $("body").addClass("mac");     
        
if(navigator.userAgent.indexOf('Safari') !=-1 && navigator.userAgent.indexOf('Chrome') == -1)
{
    $("body").addClass("safari");    
}else {
    $("body").addClass("chrome");    

      }
    }


    var cartSumWidth = $('.checkOut-col').width();
    $(window).scroll(function(e){ 
        var $el = $('.checkOut-col'); 
        var isPositionFixed = ($el.css('position') == 'fixed');
        if ($(this).scrollTop() > 400 && !isPositionFixed){ 
          $el.css({'position': 'fixed', 'top': '10px', 'width':cartSumWidth}); 
        }
        if ($(this).scrollTop() < 400 && isPositionFixed){
          $el.css({'position': 'static', 'top': '0px', 'width':'auto'}); 
        } 
      });

      if($('.product-detail-right > .cart-group .cart-btn .cart-btn-box').length===3){
        $('.product-detail-right > .cart-group .cart-btn').addClass('threeCartBtn');
        };

        /*var $listItems = $('ul.seachedResults > li');

        setTimeout(function(){
            $('input#qSearch').on('keyup',function(e)
            {
    
                var key = e.keyCode,
                    $selected = $listItems.filter('.selected'),
                    $current;
            
                if ( key != 40 && key != 38 ) return;
            
                $listItems.removeClass('selected');
            
                if ( key == 40 ) // Down key
                {
                    if ( ! $selected.length || $selected.is(':last-child') ) {
                        $current = $listItems.eq(0);
                    }
                    else {
                        $current = $selected.next();
                    }
                }
                else if ( key == 38 ) // Up key
                {
                    if ( ! $selected.length || $selected.is(':first-child') ) {
                        $current = $listItems.last();
                    }
                    else {
                        $current = $selected.prev();
                    }
                }
            
                $current.addClass('selected');
            });
        }, 10000)*/
        
       
	
	/*$('#navbar .search-input').focus(function(event){
		$('#navbar .search-result').slideDown();	
		//$(this).next().next('.search-result:hidden').slideDown();
		event.stopPropagation();
	});
	$('body').not('#navbar .search-result').on("click", function () {
		$('#navbar .search-result').slideUp();
		//event.stopPropagation();
	});
	jQuery('#navbar .search-result').click(function(event){
		event.stopPropagation();
	});*/
  

/********** Login Popup 05/03/2019 ******************/
/*$('.cart, .cart-item, .user-nav > a').on('click', function(){
    $(this).parents('.cart-nav, .user-nav').children('#login-popup').toggleClass('active');
});*/


});


 