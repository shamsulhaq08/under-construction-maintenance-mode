<style>
    .ucmm-wpbrigade-hidden{

      overflow: hidden;
    }
    .ucmm-wpbrigade-popup-overlay .ucmm-wpbrigade-internal-message{
      margin: 3px 0 3px 22px;
      display: none;
    }
    .ucmm-wpbrigade-reason-input{
      margin: 3px 0 3px 22px;
      display: none;
    }
    .ucmm-wpbrigade-reason-input input[type="text"]{

      width: 100%;
      display: block;
    }
  .ucmm-wpbrigade-popup-overlay{

    background: rgba(0,0,0, .8);
    position: fixed;
    top:0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1000;
    overflow: auto;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease-in-out:
  }
  .ucmm-wpbrigade-popup-overlay.ucmm-wpbrigade-active{
    opacity: 1;
    visibility: visible;
  }
  .ucmm-wpbrigade-serveypanel{
    width: 600px;
    background: #fff;
    margin: 65px auto 0;
  }
  .ucmm-wpbrigade-popup-header{
    background: #f1f1f1;
    padding: 20px;
    border-bottom: 1px solid #ccc;
  }
  .ucmm-wpbrigade-popup-header h2{
    margin: 0;
  }
  .ucmm-wpbrigade-popup-body{
      padding: 10px 20px;
  }
  .ucmm-wpbrigade-popup-footer{
    background: #f9f3f3;
    padding: 10px 20px;
    border-top: 1px solid #ccc;
  }
  .ucmm-wpbrigade-popup-footer:after{

    content:"";
    display: table;
    clear: both;
  }
  .ucmm-action-btns{
    float: right;
  }
  .ucmm-wpbrigade-anonymous{

    display: none;
  }
  .attention, .error-message {
    color: red;
    font-weight: 600;
    display: none;
  }
  .ucmm-wpbrigade-spinner{
    display: none;
  }
  .ucmm-wpbrigade-spinner img{
    margin-top: 3px;
  }

</style>
<div class="ucmm-wpbrigade-popup-overlay">
  <div class="ucmm-wpbrigade-serveypanel">
    <form action="#" method="post" id="ucmm-wpbrigade-deactivate-form">
    <div class="ucmm-wpbrigade-popup-header">
      <h2><?php _e( 'Quick feedback', 'ucmm-wpbrigade' ); ?></h2>
    </div>
    <div class="ucmm-wpbrigade-popup-body">
      <h3><?php _e( 'If you have a moment, please let us know why you are deactivating:', 'ucmm-wpbrigade' ); ?></h3>
      <ul id="ucmm-wpbrigade-reason-list">
        <li class="ucmm-wpbrigade-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="1">
            </span>
            <span><?php _e( 'I only needed the plugin for a short period', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
        </li>
        <li class="ucmm-wpbrigade-reason has-input" data-input-type="textfield">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="2">
            </span>
            <span><?php _e( 'I found a better plugin', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
          <div class="ucmm-wpbrigade-reason-input"><span class="message error-message "><?php _e( 'Kindly write down the plugin name.', 'ucmm-wpbrigade' ); ?></span><input type="text" name="better_plugin" placeholder="What's the plugin's name?"></div>
        </li>
        <li class="ucmm-wpbrigade-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="3">
            </span>
            <span><?php _e( 'The plugin broke my site', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
        </li>
        <li class="ucmm-wpbrigade-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="4">
            </span>
            <span><?php _e( 'The plugin suddenly stopped working', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
        </li>
        <li class="ucmm-wpbrigade-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="5">
            </span>
            <span><?php _e( 'I no longer need the plugin', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
        </li>
        <li class="ucmm-wpbrigade-reason" data-input-type="" data-input-placeholder="">
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="6">
            </span>
            <span><?php _e( "It's a temporary deactivation. I'm just debugging an issue.", 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
        </li>
        <li class="ucmm-wpbrigade-reason has-input" data-input-type="textfield" >
          <label>
            <span>
              <input type="radio" name="ucmm-wpbrigade-selected-reason" value="7">
            </span>
            <span><?php _e( 'Other', 'ucmm-wpbrigade' ); ?></span>
          </label>
          <div class="ucmm-wpbrigade-internal-message"></div>
          <div class="ucmm-wpbrigade-reason-input"><span class="message error-message "><?php _e( 'Kindly tell us the reason so we can improve.', 'ucmm-wpbrigade' ); ?></span><input type="text" name="other_reason" placeholder="What's the plugin's name?"></div>
        </li>
      </ul>
    </div>
    <div class="ucmm-wpbrigade-popup-footer">
      <label class="ucmm-wpbrigade-anonymous"><input type="checkbox" /><?php _e( 'Anonymous feedback', 'ucmm-wpbrigade' ); ?></label>
        <input type="button" class="button button-secondary button-skip loginpress-popup-skip-feedback" value="Skip &amp; Deactivate" >
      <div class="ucmm-action-btns">
        <span class="ucmm-wpbrigade-spinner"><img src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt=""></span>
        <input type="submit" class="button button-secondary button-deactivate ucmm-wpbrigade-popup-allow-deactivate" value="Submit &amp; Deactivate" disabled="disabled">
        <a href="#" class="button button-primary ucmm-wpbrigade-popup-button-close"><?php _e( 'Cancel', 'ucmm-wpbrigade' ); ?></a>

      </div>
    </div>
  </form>
    </div>
  </div>


  <script>
    (function( $ ) {

      $(function() {

        var pluginSlug = 'under-construction-maintenance-mode';
        // Code to fire when the DOM is ready.

        $(document).on('click', 'tr[data-slug="' + pluginSlug + '"] .deactivate', function(e){
          e.preventDefault();
          $('.ucmm-wpbrigade-popup-overlay').addClass('ucmm-wpbrigade-active');
          $('body').addClass('ucmm-wpbrigade-hidden');
        });
        $(document).on('click', '.ucmm-wpbrigade-popup-button-close', function () {
          close_popup();
        });
        $(document).on('click', ".ucmm-wpbrigade-serveypanel,tr[data-slug='" + pluginSlug + "'] .deactivate",function(e){
            e.stopPropagation();
        });

        $(document).click(function(){
          close_popup();
        });
        $('.ucmm-wpbrigade-reason label').on('click', function(){
          if($(this).find('input[type="radio"]').is(':checked')){
            //$('.ucmm-wpbrigade-anonymous').show();
            $(this).next().next('.ucmm-wpbrigade-reason-input').show().end().end().parent().siblings().find('.ucmm-wpbrigade-reason-input').hide();
          }
        });
        $('input[type="radio"][name="ucmm-wpbrigade-selected-reason"]').on('click', function(event) {
          $(".ucmm-wpbrigade-popup-allow-deactivate").removeAttr('disabled');
        });
        $(document).on('submit', '#ucmm-wpbrigade-deactivate-form', function(event) {
          event.preventDefault();

          var _reason =  $('#ucmm-wpbrigade-deactivate-form input[type="radio"][name="ucmm-wpbrigade-selected-reason"]:checked').val();
          var _reason_details = '';
          if ( _reason == 2 ) {
            _reason_details = $("#ucmm-wpbrigade-deactivate-form input[type='text'][name='better_plugin']").val();
          } else if ( _reason == 7 ) {
            _reason_details = $("#ucmm-wpbrigade-deactivate-form input[type='text'][name='other_reason']").val();
          }

          if ( _reason == 7 && _reason_details == '' ) {
            $('.message.error-message').show();
            return ;
          } else if ( _reason == 2 && _reason_details == '' ) {
            $('.message.error-message').show();
            return ;
          }

          $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
              action        : 'ucmm_deactivate',
              reason        : _reason,
              reason_detail : _reason_details,
              slug          : pluginSlug,
              security			: mc_api.security,
            },
            beforeSend: function(){
              $(".ucmm-wpbrigade-spinner").show();
              $(".ucmm-wpbrigade-popup-allow-deactivate").attr("disabled", "disabled");
            }
          })
          .done(function() {
            $(".ucmm-wpbrigade-spinner").hide();
            $(".ucmm-wpbrigade-popup-allow-deactivate").removeAttr("disabled");
            window.location.href =  $("tr[data-slug='"+ pluginSlug +"'] .deactivate a").attr('href');
          });

        });

        $('.loginpress-popup-skip-feedback').on('click', function(e){
          // e.preventDefault();
          window.location.href =  $("tr[data-slug='"+ pluginSlug +"'] .deactivate a").attr('href');
        })
        function close_popup() {
          $('.ucmm-wpbrigade-popup-overlay').removeClass('ucmm-wpbrigade-active');
          $('#ucmm-wpbrigade-deactivate-form').trigger("reset");
          $(".ucmm-wpbrigade-popup-allow-deactivate").attr('disabled', 'disabled');
          $(".ucmm-wpbrigade-reason-input").hide();
          $('body').removeClass('ucmm-wpbrigade-hidden');
          $('.message.error-message').hide();
        }
        });

        })( jQuery ); // This invokes the function above and allows us to use '$' in place of 'jQuery' in our code.
  </script>
