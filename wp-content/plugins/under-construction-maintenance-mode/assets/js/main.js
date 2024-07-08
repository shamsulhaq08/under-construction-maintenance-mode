(function($) {


    //   if ( $("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").val() == '' ) {
    //     $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").hide();
    //     $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").next().html("Please Enter the API Key to access the MailChimp List.");
    //   }

    // $("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").on('keyup', function(e) {

    //     if ($("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").val() != '') {
    //         var r = $('<input type="button" value="new button" id="ucmm-mc-api"/>');
    //         $("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").next().html(r);
    //         // $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").show();
    //         // $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").next().html("Select the List.");
    //     } else {
    //         // $("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").next().html("Mail Chimp Key.");
    //         // $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").hide();
    //         // $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").next().html("Please Enter the API Key to access the MailChimp List.");
    //     }


    // });
    //   $(document).on( 'click', "#ucmm-mc-api", function(e) {

    //   // getting the value.
    //   var apiKey = $("#ucmm_wpbrigade_mc_lists\\[ucmm-mc-api-key\\]").val();
    //   e.preventDefault();
    //   $.ajax({
    //     url : mc_api.ajaxurl,
    //     type : 'post',
    //     data : 'apiKey=' + apiKey + '&action=ucmm_mc_api',
    //     beforeSend: function() {
    //       $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").next().append('<img src="' + mc_api.loader + '">');
    //     },
    //     success : function( response ) {

    //     $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").show();
    //     $('#ucmm_wpbrigade_mc_lists\\[selectbox\\]').append( response );
    //     $("#ucmm_wpbrigade_mc_lists\\[selectbox\\]").next().html("Select the List.");
    //     // console.log(response);
    //     },
    //     error: function(xhr, textStatus, errorThrown){
    //       // console.log('Ajax Not Working');
    //       mc_api.loader;
    //     }
    //   });
    //   });

    /** Help file download script **/

    $("#wpuf-ucmm_wpbrigade_setting\\[ucmm-status\\]").on('click', function() {

        ucmm_toggle_Settings();
    });

    function ucmm_toggle_Settings() {

        if ($("#wpuf-ucmm_wpbrigade_setting\\[ucmm-status\\]").is(":checked")) {
            $('tr.ucmm-enable').fadeIn();
            $('tr.ucmm-enable').show();
        } else {
            $('tr.ucmm-enable').fadeOut();
            $('tr.ucmm-enable').hide();

        }
    }

    ucmm_toggle_Settings();

    $('.ucmm-wpbrigade-log-file').on('click', function(event) {

        event.preventDefault();

        $.ajax({

            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'ucmm_help',
                'help_nonce': mc_api.help_nonce
            },
            beforeSend: function() {
                $('.ucmm-log-file-sniper').show();
            },
            success: function(response) {

                $('.ucmm-log-file-sniper').hide();
                $('.ucmm-log-file-text').show();

                if (!window.navigator.msSaveOrOpenBlob) { // If msSaveOrOpenBlob() is supported, then so is msSaveBlob().
                    $('<a />', {
                            "download": 'under-construction-log.txt',
                            "href": 'data:text/plain;charset=utf-8,' + encodeURIComponent(response),
                        }).appendTo("body")
                        .click(function() {
                            $(this).remove()
                        })[0].click()
                } else {
                    var blobObject = new Blob([response]);
                    window.navigator.msSaveBlob(blobObject, 'under-construction-log.txt');
                }

                setTimeout(function() {
                    $(".ucmm-log-file-text").fadeOut()
                }, 3000);
            }
        });

    });

})(jQuery);