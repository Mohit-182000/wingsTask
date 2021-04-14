var DatatablesDataSourceHtml = function () {

    var initJobPostTable = function () {
        var table = $('#ticketTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Subject"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#ticketTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": {
                    // return $.extend({}, d, {});
                    subject : $('#subject').val(), 
                    priority : $('#priority').val(), 
                    status : $('#status').val(), 
                    user : $('#user').val(), 
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                "data": "id"
            },
            {
                "data": "subject"
            },
            {
                "data": "priority_id"
            },
            {
                "data": "status_id"
            },
            {
                "data": "user_id"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initJobPostTable();
        },

    };

}();


jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();

    
    $('.select2').select2({
        theme: 'bootstrap4',

        allowClear: true,
        ajax: {
            url: function () {
                return $(this).data('url');
            },
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                            otherfield: item,
                        };
                    }),
                }
            },
            //cache: true,
            delay: 250
        },
        // minimumInputLength: 2,
    });

    $('.select2-subject').select2({
        theme: 'bootstrap4',

        allowClear: true,
        ajax: {
            url: function () {
                return $(this).data('url');
            },
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.subject,
                            text: item.subject,
                            otherfield: item,
                        };
                    }),
                }
            },
            //cache: true,
            delay: 250
        },
        // minimumInputLength: 2,
    });
    
    $("#search").click(function(){
        $('#ticketTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });

    $("#btn_clear").click(function(){
        $('.select2').val('').trigger('change');
        $('.select2-subject').val('').trigger('change');
        $('.jobStatusSelect2').val('').trigger('change');
        $('#ticketTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });
});
