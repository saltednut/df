import 'popper.js';
import 'bootstrap';
import '@fortawesome/fontawesome-free/js/all';

(function ($, Drupal, window) {
  'use strict';

  Drupal.behaviors.layoutBuilderModal = {
    attach: function attach(context, settings) {
      var lbm = $('#layout-builder-modal');
      var lbmTextInputs = $('#layout-builder-modal input[type="text"]');
      // Add active class to label so we can change it's position.
      lbmTextInputs.parent().addClass('input-field');
      lbmTextInputs.focus(function() {
        $(this).parent().find("label").addClass("active");
      });
      lbmTextInputs.focusout(function() {
        if (!$(this).val()){
          $( this ).parent().find( "label").removeClass("active");
        }
      });
      lbmTextInputs.each(function(){
        if ($(this).val()){
          $(this).parent().find("label").addClass("active");
        }
      });

      $(document).ready(function () {
        if (lbm.dialog('isOpen') === true) {
          // Close modal if clicked outside.
          $('.ui-widget-overlay').bind('click', function () {
            lbm.dialog('close');
          });
        }
      });
    }
  };

  Drupal.behaviors.updateLBM = {
    attach: function() {
      $(document).ready(function () {
        $(window).once('updateLBM').on('dialog:aftercreate', function () {
          if ($('#layout-builder-modal').length) {
            $('#layout-builder-modal').dialog({
              draggable: true,
            });
            $('#layout-builder-modal').parent().addClass('lbm').css('z-index','1201');
          }
        });
      });
    }
  };

})(jQuery, Drupal, window);
