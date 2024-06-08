<style>
div#myloading {
    width: 100% !important;
    position: absolute;
    
    padding: 20px 0px;
    background: #fff;
    left: 0;
    right: 0;
}
</style>
<script>
    var nearToBottom = 50;
    var total_pages = parseInt("{{$items->lastPage()}}");
    var page = {{ $items -> currentPage() }};
    var needScroll = true;
    //$("#thistbody").remove();
    //loadResults(page);
    if (page < total_pages) {
        $(window).scroll(function () {
            //alert(page);    
            if ($(window).scrollTop() + $(window).height() > $(document).height() - nearToBottom) {
                if (page > total_pages) {
                    return false;
                } else {
                    if (needScroll) {
                        page++;
                        needScroll = false;
                        loadResults(page);
                    }
                }
            }
        });
    }

    function loadResults(page) {
        $("#tbody").append('<div id="myloading" class="col-md-12" style="text-align:center;"><img src="{{ asset("public/admin/images/ajax-loader.gif")}}" /> Loading Data...</div></div>');
        var newurl = '';
        var reslt = location.search;
        if(reslt != ''){
            newurl = reslt+'&page=' + page;
        } else {
            newurl = '?page=' + page;
        }
        $.ajax({
            url: newurl,
            type: "get",
            dataType: "HTML",

            success: function (data) {
                $("#myloading").remove();
                $("#tbody").append(data);
                needScroll = true;
            }
        });
    };
    $('#bulkmaster').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $('#actionbutton').show();
            $(".sub_chk").prop('checked', true);
        } else {
            $('#actionbutton').hide();
            $(".sub_chk").prop('checked', false);
        }
    });

    $('.sub_chk').on('click', function (e) {
        var generallen = $(".sub_chk:checked").length;
        if(generallen>0){
            $('#actionbutton').show();
        }else{
            $('#actionbutton').hide();
        }
    });
</script>
<script>
$('.bulk_action').on('click', function (e) {

var allVals = [];
$(".sub_chk:checked").each(function () {
    allVals.push($(this).attr('data-id'));
});

if (allVals.length <= 0) {
    $('#alertmessagehere').html(
        '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>Please select product to delete.</div>'
        );
} else {
    $('#alertmessagehere').html('');
    var join_selected_values = allVals.join(",");
    $.ajax({
        url: $(this).data('url'),
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: 'ids=' + join_selected_values,
        success: function (data) {
            // alert(data['ids']);
            if (data == 'success') {
                $(".sub_chk").prop('checked', false);
                location.reload();
            } else if (data['error']) {
                $('#alertmessagehere').html(
                    '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>' +
                    data['error'] + '</div>');

            } else {
                $('#alertmessagehere').html(
                    '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>Whoops Something went wrong!!</div>'
                    );
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
}
});
</script>