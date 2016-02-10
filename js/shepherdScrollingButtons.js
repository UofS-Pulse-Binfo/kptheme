(function ($) {
Drupal.kptheme = {
  shepherd: {
    scrollingButtons: function(prevStepSelector, nextStepSelector, isLastStep) {
      isLastStep = isLastStep || false;
      secondButton = 'Next';
      secondButtonClass = 'shepherd-button-primary';
      if (isLastStep) { secondButton = 'Done';  secondButtonClass = 'shepherd-button-complete'; }
      return [
          {
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
          },
          {
              text: secondButton,
              action: function() {
                // Move on to the next step.
                tour.next();
                // Now, scroll to the next step.
                $('html, body').animate({
                  scrollTop: $(nextStepSelector).offset().top-100
                }, 1000);
              },
              classes: secondButtonClass
            }
        ];
    }
  }}
}(jQuery));

