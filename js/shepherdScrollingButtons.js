(function ($) {
Drupal.kptheme = {
  shepherd: {
    scrollingButtons: function(prevStepSelector, nextStepSelector, isLastStep) {
      isLastStep = isLastStep || false;
      var buttons = [];
      
      if (prevStepSelector) {
        buttons.push({
          text: 'Back',
          action: function() {
              // Move on to the next step.
              tour.back();
              // Now, scroll to the next step.
              $('html, body').animate({
                scrollTop: $(prevStepSelector).offset().top-100
              }, 1000);
            },
          classes: 'shepherd-button-secondary'
        });
      }
      if (isLastStep) { 
        buttons.push({
          text: 'Done',
          action: function() {
              // Move on to the next step.
              tour.complete();
              // Now, scroll to the next step.
              $('html, body').animate({
                scrollTop: $(nextStepSelector).offset().top-100
              }, 1000);
            },
          classes: 'shepherd-button-complete'
        });
      }
      else {
        buttons.push({
          text: 'Next',
          action: function() {
              // Move on to the next step.
              tour.next();
              // Now, scroll to the next step.
              $('html, body').animate({
                scrollTop: $(nextStepSelector).offset().top-100
              }, 1000);
            },
          classes: 'shepherd-button-primary'
        });
      }

      return buttons;
    }
  }}
}(jQuery));

