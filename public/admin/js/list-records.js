    var recordList = function(){
                var tblObj = $("#record-list");
                $.ajax({
                    url: tblObj.data('url'),
                    type : 'GET',
                    data : {sync:1},
                    dataType: 'json'
                })
                        .success(function(response) {
                            tblObj.find('tbody').html(response.rows);
                            tblObj.find('tfoot tr td').html(response.pagination);
                            reinitPagination();
                            //initPosition();
                        })
                        .error(function(response, code) {
                            //toastr.error('Error in listing rows');
                        });
            };

    recordList();

    var reinitPagination = function(){
        $('.pagination a').on('click', function(e){
            e.preventDefault();
            $("#record-list").data('url', (listURL + '?cursor=' + $(this).data('cursor') + '&trasition=' + $(this).data('type')));
            recordList();
        });
    }

    
    var searchList = function(){
        var tblObj = $("#record-list");
        $.ajax({
            url: searchUrl,
            type : 'GET',
            data : {sync:1,q:$('#searchQ').val()},
            dataType: 'json'
        })
                .success(function(response) {
                    tblObj.find('tbody').html(response.rows);
                    tblObj.find('tfoot tr td').html(response.pagination);
                    reinitSearchedPagination();
                })
                .error(function(response, code) {
                    //console.log('Error in listing rows');
                });
    };

var reinitSearchedPagination = function(){
    $('.pagination a').on('click', function(e){
        e.preventDefault();
        searchUrl =  searchUrl1 + '?cursor=' + $(this).data('cursor') + '&trasition=' + $(this).data('type') +'&q='+$('#searchQ').val();
        //searchUrl = $(this).attr('href')+'&qfilter='+$('#searchQFilter').val()+'&q='+$('#searchQ').val();
        searchList();
    });
}

var recordList1 = function(){
    var tblObj = $("#record-list1");
    $.ajax({
        url: tblObj.data('url'),
        type : 'GET',
        data : {sync:1},
        dataType: 'json'
    })
            .success(function(response) {
                tblObj.find('tbody').html(response.rows);
                tblObj.find('tfoot tr td').html(response.pagination);
                reinitPagination1();
                //initPosition();
            })
            .error(function(response, code) {
                //toastr.error('Error in listing rows');
            });
};

recordList1();

var reinitPagination1 = function(){
$('.pagination a').on('click', function(e){
e.preventDefault();
$("#record-list1").data('url', $(this).attr('href'));
recordList1();
});
}


