/* upload image */

$(".upload_image").dropzone({       
     paramName: "image",
     maxFilesize: 2,
     url: uploadUrl,
     uploadMultiple: false,
     acceptedFiles: 'image/*',
     previewTemplate: '<i class="hidden preview-image"></i>',        
     parallelUploads: 1,
     success: function(file, data) {            
         $(".image-upload-container").find('img').attr('src',data.thumb_image);
         $(".image-upload-container").slideDown();
         $(".upload_image").parent('.form-group').hide();
         $("#image").val(data.image);      
     },
     uploadprogress: function(file, progress, bytesent) {
         var elm = $(this)[0].element;
         var _prt = $(elm).parent('.form-group');
         _prt.find('#image-progress').html(parseInt(progress) + '%');
     },
     sending: function(file, xhr, formData) {
         var elm = $(this)[0].element;
         formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
     },
     error: function(file,data) {
         toastr.error(data);
         var elm = $(this)[0].element;
         var _prt = $(elm).parent('.form-group');
         _prt.find('#image-progress').html(parseInt(0) + '%');
         jQuery.each(data.errors, function(i, _msg) {
            toastr.error(_msg[0]);
            $(elm).parents('.form-group').addClass('has-error');
            $(elm).parents('.form-group').find('.help-block').html(_msg[0]);
            
          });
         
     }
 });

 
/*remove image*/
var removeImage = function(form, elm){
    var res = confirm('Are you sure, You want to remove this!');
    if(res){
      var id = $(elm).parent().closest('.row').find('#id').val();
      var image = $(elm).parent().closest('.row').find('#image').val();
      axios({
            method: 'post',
            url: removeUrl,
            data:"id="+id+"&image="+image
          })
          .then(function (response){           
              if(response.data){
                $(elm).parent().closest('.row').find(".image-upload-container").slideUp();
                $(elm).parent().closest('.row').find(".image-upload-container").find('img').attr('src','');
                $(elm).parent().closest('.row').find(".upload_image").parent('.form-group').show();      
                $(elm).parent().closest('.row').find("#image").val('');  
                $(elm).parent().closest('.row').find("#image-progress").html('');    
                setTimeout(function(){             
                  toastr.success(response.data.message);  
                },1000);
              }
            })
            .catch(function (error) { 
              if (error.response) {
                 var message =  error.response.data.message;                                  
                  toastr.error(message);
              }  
            }); 
         return false; 
       }
     
   
   };


/* upload multiple image */

$(".upload_multiple_image").dropzone({       
    paramName: "image",
    maxFilesize: 2,
    url: uploadUrl,
    uploadMultiple: true,
    acceptedFiles: 'image/*',
    previewTemplate: '<i class="hidden preview-image"></i>',        
    parallelUploads: 1,
    success: function(file, data) {            
        $(".image-upload-container").find('img').attr('src',data.thumb_image);
        $(".image-upload-container").slideDown();
        $(".upload_image").parent('.form-group').hide();
        $("#image").val(data.image);      
    },
    uploadprogress: function(file, progress, bytesent) {
        var elm = $(this)[0].element;
        var _prt = $(elm).parent('.form-group');
        _prt.find('#image-progress').html(parseInt(progress) + '%');
    },
    sending: function(file, xhr, formData) {
        var elm = $(this)[0].element;
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
    },
    error: function(file,data) {
        toastr.error(data);
        var elm = $(this)[0].element;
        var _prt = $(elm).parent('.form-group');
        _prt.find('#image-progress').html(parseInt(0) + '%');
        jQuery.each(data.errors, function(i, _msg) {
            toastr.error(_msg[0]);
            $(elm).parents('.form-group').addClass('has-error');
            $(elm).parents('.form-group').find('.help-block').html(_msg[0]);
            
          });
        
    }
});


/* upload file */

$(".upload_file").dropzone({                
    paramName: "file",
    maxFilesize: 10,
    url: uploadFileUrl,
    uploadMultiple: false,
    acceptedFiles: ".mp4,.avi,.mov",
    previewTemplate: '<i class="hidden preview-image"></i>',        
    parallelUploads: 1,
    success: function(file, data) {
        $('.upload_dis').hide();               
        $("#file-progress").html('');  
        $(".file-container").html('');    
        $(".file-container").html('<a href="'+data.file_path+'" target="_blank">'+data.file+'</a>');    
        $("#video").val(data.file); 
        $(".file-upload-container").slideDown();    
    },
    uploadprogress: function(file, progress, bytesent) {
        var elm = $(this)[0].element;
        var _prt = $(elm).parent('.upload_dis');
        _prt.find('#file-progress').html(parseInt(progress) + '%');
    },
    sending: function(file, xhr, formData) {
        var elm = $(this)[0].element;
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
    },
    error: function(file,data) {
        toastr.error(data);
        var elm = $(this)[0].element;
        var _prt = $(elm).parent('.upload_dis');
        _prt.find('#file-progress').html(parseInt(0) + '%');
        jQuery.each(data.errors, function(i, _msg) {
            toastr.error(_msg[0]);
            $(elm).parents('.form-group').addClass('has-error');
            $(elm).parents('.form-group').find('.help-block').html(_msg[0]);
          });
    }
});

/*remove File*/

var removeVideo = function(form){    
var res = confirm('Are you sure, You want to remove this!');

if(res){
  var _frm = $(form);
  var id = _frm.find('#id').val();
  var file = _frm.find('#video').val();
  axios({
        method: 'post',
        url: removeFileUrl,
        data:"id="+id+"&file="+file
      })
      .then(function (response){           
          if(response.data){
           var fileUploadContainer = $(".file-upload-container");  
           $(".file-upload-container").slideUp(); 
           $(".file-container").html('');              
           $(".upload_file").parent('.form-group').show();      
           $("#video").val('');         
           $("#file-progress").html(''); 
            setTimeout(function(){             
              toastr.success(response.data.message);  
            },2000);
          }
        })
        .catch(function (error) { 
          if (error.response) {
             var message =  error.response.data.message;                                  
              toastr.error(message);
          }  
        }); 
     return false; 
   }
 
};


var initDrop = function(divLength){
    $(".upload_image"+divLength).dropzone({       
        paramName: "image",
        maxFilesize: 2,
        url: uploadUrl,
        uploadMultiple: false,
        acceptedFiles: 'image/*',
        previewTemplate: '<i class="hidden preview-image"></i>',        
        parallelUploads: 1,
        success: function(file, data) { 
            //alert(data.thumb_image);
            var elm = $(this)[0].element;     
            $(elm).parent().closest('.row').find(".image-upload-container").find('img').attr('src',data.thumb_image);
            $(elm).parent().closest('.row').find(".image-upload-container").slideDown();
            $(elm).parent().closest('.row').find(".upload_image").parent('.form-group').hide();
            $(elm).parent().closest('.row').find("#image").val(data.image);      
        },
        uploadprogress: function(file, progress, bytesent) {
            var elm = $(this)[0].element;
            var _prt = $(elm).parent('.form-group');
            _prt.find('#image-progress').html(parseInt(progress) + '%');
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        },
        error: function(file,data) {
            toastr.error(data);
            var elm = $(this)[0].element;
            var _prt = $(elm).parent('.form-group');
            _prt.find('#image-progress').html(parseInt(0) + '%');
            jQuery.each(data.errors, function(i, _msg) {
               toastr.error(_msg[0]);
               $(elm).parent('.form-group').addClass('has-error');
               $(elm).parent('.form-group').find('.help-block').html(_msg[0]); 
             }); 
        }
    });
}

initDrop('');
