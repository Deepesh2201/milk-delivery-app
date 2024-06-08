/* save into database */
var saveData = function(_form){
  
    var frm = jQuery(_form);       
    var btn = frm.find(".saveBtn");       
    var loader = frm.find("#ajaxloader"); 
    var msg = frm.find("#msg"); 
    btn.attr("disabled", true);
    //alert(btn.text()); exit();
    btn.hide();
    loader.show();
    axios({
       method: 'post',
       url: frm.attr('action'),
       data:frm.serialize(),
       onUploadProgress: function (progressEvent) {
         btn.hide();
         btn.attr("disabled", true);
         loader.show();
       }
     })
     .then(function (response){
        btn.attr("disabled", false);            
         if(response.data){
           frm.find('.form-group').removeClass('has-error');
           frm.find('.help-block').html('');
           if(frm.find("#id") ){
              //frm[0].reset();  
           } 
           setTimeout(function(){
            msg.html(response.data.message);
            window.location.href=response.data.redirect;             
             loader.hide();
             btn.show();
           },2000);
           setTimeout(function(){
            msg.html('');
           },8000);
         }
       })
       .catch(function (error) {            
         loader.hide();
         btn.attr("disabled", false);
         btn.show();
         if (error.response) {
            var errors =  error.response.data.errors;
             frm.find('.form-group').removeClass('has-error');
             frm.find('.help-block').html('');
             jQuery.each(errors, function(i, _msg) {
              if(i == 'privillage'){
                $(".privillage").show();
              } 
              console.log(i);
               /*if(i == 'image'){
                  var el = frm.find(".upload_image");
               }
               else if(i == 'file'){
                var el = frm.find(".upload_file");
              }
               else{*/
                 var el = frm.find("[name="+i+"]");
               //}
	
               el.parents('.form-group').addClass('has-error');
               el.parents('.form-group').find('.help-block').html(_msg[0]);
                window.scrollTo({ top: 0, behavior: 'smooth' });
             });
         }  
       }); 
    return false;    
};  

/* remove items from cart */
var removeItem = function(product_id, route_url){  
  alert("sdfsd");
  $('.loading').show();   
  let token = $('meta[name="csrf_token"]').attr('content');
  axios({
     method: 'post',
     url: route_url,
     data:{
      _token:token,
      product_id:product_id}
   })
   .then(function (response){  
    $('.loading').hide();          
       if(response.data){
        if(response.data.success){
          location.reload();
          toastr.success(response.data.message);          
        }else {
          toastr.error(response.data.message);
         }
       }
     })
     .catch(function (error) { 
      $('.loading').hide();           
      if (error.response) {
        var errors =  error.response.data.errors;
        jQuery.each(errors, function(i, _msg) {
          toastr.error(_msg[0]);
        });
    }
     }); 
  return false;    
};

/* save into database */
var saveDataWithMultiSelect = function(_form){
  var selectionMulti = $.map($("#multi-selection option:selected"), function (el, i) {
    if($(el).val() != "")
    return $(el).val();
  });
  $("#multi-selection-value").val(selectionMulti.join(","));
  var frm = jQuery(_form);       
  var btn = frm.find(".saveBtn");       
  var loader = frm.find("#ajaxloader"); 
  var msg = frm.find("#msg"); 
  
  axios({
     method: 'post',
     url: frm.attr('action'),
     data:frm.serialize(),
     onUploadProgress: function (progressEvent) {
       btn.hide();
       loader.show();
     }
   })
   .then(function (response){            
       if(response.data){
         frm.find('.form-group').removeClass('has-error');
         frm.find('.help-block').html('');
         if(frm.find("#id") ){
            //frm[0].reset();  
         } 
         setTimeout(function(){
          msg.html(response.data.message);
          window.location.href=response.data.redirect;             
           loader.hide();
           btn.show();
         },2000);
         setTimeout(function(){
          msg.html('');
         },8000);
       }
     })
     .catch(function (error) {            
       loader.hide();
       btn.show();
       if (error.response) {
          var errors =  error.response.data.errors;
           frm.find('.form-group').removeClass('has-error');
           frm.find('.help-block').html('');
           jQuery.each(errors, function(i, _msg) {
             //console.log(i);
             /*if(i == 'image'){
                var el = frm.find(".upload_image");
             }
             else if(i == 'file'){
              var el = frm.find(".upload_file");
            }
             else{*/
               var el = frm.find("[name="+i+"]");
             //}
             el.parents('.form-group').addClass('has-error');
             el.parents('.form-group').find('.help-block').html(_msg[0]);
             
           });
       }  
     }); 
  return false;    
};

/// Password Show Hide

$(".toggle-password").click(function(event) {
  event.preventDefault();
  var type = $(".showpass").attr("type");    
    if (type == "password") {
      $(".showpass").attr("type", "text");
      exit;
    } else if (type == "text") {
      $(".showpass").attr("type", "password");
      exit;
    }
});

//Sk Submit Form with file 

$('#upload_form').on('submit', function (event) {
        event.preventDefault();
       
  var frm = $('#upload_form');
  var btn =  $('#upload_form').find(".saveBtn"); 
  var loader = frm.find("#ajaxloader"); 
  var msg = frm.find("#msg"); 
  btn.attr("disabled", true);
  //alert(btn.text()); exit();
  btn.hide();
  loader.show();
  axios({
     method: 'post',
     url: frm.attr('action'),
    // data:frm.serialize(),
      data:new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: true,
     onUploadProgress: function (progressEvent) {
       btn.hide();
       btn.attr("disabled", true);
       loader.show();
     }
   })
   .then(function (response){
      btn.attr("disabled", false);            
       if(response.data){
         frm.find('.form-group').removeClass('has-error');
         frm.find('.help-block').html('');
         if(frm.find("#id") ){
            //frm[0].reset();  
         } 
         setTimeout(function(){
          msg.html(response.data.message);
          window.location.href=response.data.redirect;             
           loader.hide();
           btn.show();
         },2000);
         setTimeout(function(){
          msg.html('');
         },8000);
       }
     })
     .catch(function (error) {            
       loader.hide();
       btn.attr("disabled", false);
       btn.show();
       if (error.response) {
          var errors =  error.response.data.errors;
           frm.find('.form-group').removeClass('has-error');
           frm.find('.help-block').html('');
           jQuery.each(errors, function(i, _msg) {
            if(i == 'privillage'){
              $(".privillage").show();
            } 
            console.log(i);
            
            if(i == "car_img" || i.includes("car_img")){
              var el = frm.find(".car_img");
            }else if(i.includes('car_docs')){ 
              var el = frm.find(".car_docs"); 
            }else{ 
              var el = frm.find("[name="+i+"]");
            }
             /*if(i == 'image'){
                var el = frm.find(".upload_image");
             }
             else if(i == 'file'){
              var el = frm.find(".upload_file");
            }
             else{*/
              //var el = frm.find("[name="+i+"]");
             //}
             el.parents('.form-group').addClass('has-error');
             el.parents('.form-group').find('.help-block').html(_msg[0]);
             
           });
       }  
     }); 
  return false;    
});  

/* Save Onloading feature */

var saveOnloading = function(_form){
  
  var frm = jQuery(_form);       
  var btn = frm.find(".saveBtn");       
  var loader = frm.find("#ajaxloader"); 
  var msg = frm.find("#msg"); 
  btn.attr("disabled", true);
  //alert(btn.text()); exit();
  btn.hide();
  loader.show();
  axios({
     method: 'post',
     url: frm.attr('action'),
     data:frm.serialize(),
     onUploadProgress: function (progressEvent) {
       btn.hide();
       btn.attr("disabled", true);
       loader.show();
     }
   })
   .then(function (response){
      btn.attr("disabled", false);            
       if(response.data){
         frm.find('.form-group').removeClass('has-error');
         frm.find('.help-block').html('');
         if(frm.find("#id") ){
            //frm[0].reset();  
         } 
         setTimeout(function(){
          msg.html(response.data.message);
          window.location.href=response.data.redirect;             
           loader.hide();
           btn.show();
         },2000);
         setTimeout(function(){
          msg.html('');
         },8000);
       }
     })
     .catch(function (error) {            
       loader.hide();
       btn.attr("disabled", false);
       btn.show();
       if (error.response) {
          var errors =  error.response.data.errors;
           frm.find('.form-group').removeClass('has-error');
           frm.find('.help-block').html('');
          //  console.log(errors);
           jQuery.each(errors, function(i, _msg) {           
          //  console.log(i);            
             //var myarray = ["feature.1","feature.2","feature.3","feature.4"] ;
             var myarray = [];
              $('.options').each(function(){
                var newval = this.name;
                var np = newval.replace("product[", "product.");
                var myproduct = np.replace("]", "");

                var qty = newval.replace("qty[", "qty.");
                var myQty = qty.replace("]", "");

                var price = newval.replace("price[", "price.");
                var newprice = price.replace("]", "");
              
                myarray.push(myproduct); 
                myarray.push(myQty); 
                myarray.push(newprice); 
              });
             if(jQuery.inArray(i, myarray) !== -1){
              var str = i;
              var mystr = str.replace(".","_");
              frm.find("."+mystr).html(_msg[0]);
             }else{
                var el = frm.find("[name="+i+"]");
                el.parents('.form-group').addClass('has-error');
                el.parents('.form-group').find('.help-block').html(_msg[0]);
             }                          
             window.scrollTo({ top: 0, behavior: 'smooth' });
           });
       }  
     }); 
  return false;    
};

