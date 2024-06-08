var all_images = [];
if($('#image').val() != "")
all_images = $('#image').val().split(",");

/*  Upload Files */
var myDropzone = new Dropzone("div#file-upload",
    {
        url: uploadImageUrl,
        paramName: "image",
        maxFilesize: 128,
        uploadMultiple:false,
        acceptedFiles: 'image/*',
        previewTemplate:'<i class="hidden preview-image"></i>',
        parallelUploads:1,
         success: function(file,data) {
            $(".image-upload-container").slideDown();
            $('#show-images').prepend(`<div class="img-background" style="float: left; margin-left: 15px;" >
                    <img src="`+data.thumb_image+`" class="img-responsive">
                    <a href="javascript:;" class="close-btn" onclick="return removeMultiImage(this,'.publicationsFrm')">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>`);
                
             all_images.push(data.image);
             $("#image").val(all_images); 
            $("#image-progress").html('Drop files here to upload');     
        },
        uploadprogress : function(file,progress, bytesent) {
            var elm = $(this)[0].element;
            var _prt = $(elm).parent('.form-group');
            _prt.find('#image-progress').html('Uploading ' + parseInt(progress) + '%');
        },
        sending:function(file, xhr, formData) {
            formData.append("_token", window.Laravel.csrfToken);
        },
        error: function(file,data) {
            
            jQuery.each(data.errors, function(i, _msg) {
              toastr.error(_msg[0]);
               $("#image").parents('.form-group').addClass('has-error');
               $("#image").parents('.form-group').find('.help-block').html(_msg[0]);
              
            });
            
        }
    }
  );
  Dropzone.autoDiscover = false;


  /*remove image*/
var removeMultiImage = function(ele, form){
    var res = confirm('Are you sure, You want to remove this!');
    if(res){
      var _frm = $(form);
      var id = _frm.find('#id').val();
      var image = ($(ele).prev().attr('src')).replace(imageURL, '');
      axios({
            method: 'post',
            url: removeImageUrl,
            data:"id="+id+"&image="+image
          })
          .then(function (response){           
              if(response.data){
                if($('#image').val() != "")
                all_images = $('#image').val().split(",");
                all_images.splice( all_images.indexOf(image), 1 );
                $("#image").val(all_images); 
                $(ele).parents('.img-background').hide();
                if($('#show-images').html() == ""){
               $(".image-upload-container").slideUp();     
               $("#image").val('');  
                }    
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