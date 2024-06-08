<!--container end here-->
<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Change profile picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <div class="alert" id="message" style="display: none"></div>
                <div class="alert ajaxmsg" style="display: none"></div>
                <form method="post" id="upload_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-8 mx-auto">
                                <div class="w-100 text-center">
                                <input type="file" name="select_file" id="select_file"
                                        accept="image/x-png,image/gif,image/jpeg" class="imgInp file-path validate filestyle custom-file-input"
                                        aria-describedby="inputGroupFileAddon01" data-buttonname="btn-secondary">
                                    <!-- <input type="file" name="select_file" id="select_file"/> -->
                                    <!-- <input class="file-path validate" type="file" name="select_file" id="select_file"
                                        placeholder="Choose File"> -->
                                </div>

                                <input type="hidden" name="uid" value="{{Auth::user()->id}}">
                                <div class="row">
                                    <div class="col-12 col-md-12 text-center py-3">
                                        <img id="preview" height="100" class="img-responsive" />
                                    </div>
                                </div>
                                <span class="text-muted" style="margin-left:14%;">Only jpg, jpeg and png are allowed.</span>
                            </div>

                        </div>
                        <!-- <div class="text-center py-2 white">
                            <input  class="btn btn-primary waves-eff" value="Upload">
                        </div> -->

                    </div>

            </div>
            
        
        <br />
        <span id="uploaded_image"></span>
        <div class="modal-footer"><button type="submit" name="upload" id="upload" class="btn btn-primary">Save</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
        </form>
        </div>
        
    </div>
    
</div>
</div>


@push('appendJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script language="JavaScript">
    $(function () {
        $("#web-cam").click(function () {
            $("#mycam").show();
            Webcam.set({
                width: 300,
                height: 300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        });
        $('#img-modal').on('hidden.bs.modal', function () {
            location.reload();
        })
    });

    function take_snapshot() {
        Webcam.snap(function (data_uri) {
            $("#select_file").get(0).type = 'hidden';
            $("#select_file").val(data_uri);
            $("#camimage").val('yes');

            //document.getElementById('preview').innerHTML =  
            //  $("#preview").attr('src', '');
            document.getElementById('preview').src = data_uri;
            //  $("#preview").removeAttr('src');

            //document.getElementById('results').style.display = 'block';
            // $("#img-modal").modal('hide')
        });
    }
</script>
@endpush