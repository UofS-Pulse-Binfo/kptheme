  (function ($) {
  Drupal.behaviors.crossManageWorkflow = {
  attach: function (context, settings) {
    $( "#uofs-wild-species-accordion" ).accordion({
      collapsible: true,
      active: 0,
      heightStyle: "content"
     });
    }
   };
  })(jQuery);
