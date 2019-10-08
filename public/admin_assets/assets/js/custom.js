/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
jQuery(document).ready(function ($) {

    $('#users_page_search_clear').on('click', function(e) {
        e.preventDefault();
        if($(this).data('url')) {
            location.href = $(this).data('url');
        }
        return false;
    });

    $('#confirm_delete_contacts').on('show.bs.modal', function (e) {
        var invoker = $(e.relatedTarget);
        $('#contact-applications-delete').attr('action', invoker.attr('href'));
    });

    $('.js-confirm').on('click', function () {
        $('#contact-applications-delete').submit();

        return false;
    });

    if ($('#title_h1_blog').length) {
        $('#title_h1_blog').on('change', function (e) {
            let form  = $(this).closest('form');
            //ajax headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //send ajax
            $.ajax({
                url: '/administrator/blogs/alias/get',
                data: form.serialize(),
                type: 'POST',
                dataType: 'json'
            })
                .done(function (html) {
                    //if send is Ok
                    if (html.status == 'success') {
                        form.find('input[name="alias"]').val(html.alias);
                    }
                });
        })
    }

});