$('#userTable').DataTable({
    "processing": true,
    "serverSide": true,
    "stateSave": true,
    "lengthMenu": [10, 25, 50],
    "responsive": true,
    "language": {
        searchPlaceholder: " Id or User"
    },
    // "iDisplayLength": 2,
    "ajax": {
        "url": $('#userTable').attr('data-url'),
        "dataType": "json",
        "type": "POST",
        "data": function (d) {
            return $.extend({}, d, {});
        }
    },
    "order": [
        [0, "desc"]
    ],
    "columns": [{
        "data": "id"
    },
    {
        "data": "name"
    },
    {
        "data": "email"
    },
    {
        "data": "action"
    }
    ]
});