$(document).ready(function () {
    $(document).on('click', '.delete-confrim', function (e) {
        e.preventDefault();

        var el = $(this);
        var url = el.attr('href');
        var id = el.data('id');
        var refresh = el.closest('table');

        message.fire({
            title: 'Are you sure',
            text: "You want to delete this ?",
            type: 'warning',
            customClass: {
                confirmButton: 'btn btn-success shadow-sm mr-2',
                cancelButton: 'btn btn-danger shadow-sm'
            },
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.value) {

                //showLoader();
                $.ajax({
                    type: "POST",
                    url: url,
                    cache: false,
                    data: {
                        id: id,
                        _method: 'DELETE'
                    }
                }).always(function (respons) {

                    //stopLoader();

                    $(refresh).DataTable().ajax.reload();

                }).done(function (respons) {

                    message.fire({
                        type: 'success',
                        title: 'Success',
                        text: respons.message
                    });

                }).fail(function (respons) {
                    console.log(respons);
                    var data = respons.responseJSON;
                    if(respons.responseJSON.errormessage){
                        data.message = 'This data is use in other modules so you can’t delete';
                    }
                    if(respons.responseJSON.catgeorymessage){
                        data.message = 'This data is use in parent so you can’t delete';
                    }

                    message.fire({
                        type: 'error',
                        title: 'Error',
                        text: data.message ? data.message :
                            'something went wrong please try again !'
                    });

                });
            }
        });

    });

    $(document).on('click', '.change-status', function (e) {

        var el = $(this);
        var url = el.data('url');
        var table = el.data('table');
        // alert(table);
        var id = el.val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: id,
                status: el.prop("checked"),
                table: table,
            }
        }).always(function (respons) {}).done(function (respons) {

            message.fire({
                type: 'success',
                title: 'Success',
                text: respons.message
            });

        }).fail(function (respons) {

            message.fire({
                type: 'error',
                title: 'Error',
                text: 'something went wrong please try again !'
            });

        });

    });

    $(document).on('click', '.call-model', function (e) {

        e.preventDefault();
        // return false;
        var el = $(this);
        var url = el.data('url');
        var target = el.data('target-modal');

        $.ajax({
            type: "GET",
            url: url
        }).always(function () {
            $('#load-modal').html(' ')
        }).done(function (res) {
            $('#load-modal').html(res.html);
            $(target).modal('toggle');
        });

    });

});
