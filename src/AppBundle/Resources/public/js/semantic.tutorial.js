(function ( $ ) {
    $.fn.tutorial = function(arg) {
        var defaults = {
            on          : 'manual',
            inline      : true,
            hoverable   : true,
            hideOnScroll: false,
            closable    : false,
            delay: {
                show: 50,
                hide: 1000000000
            },
            inverted    : true
        };
        var options = $.extend({}, defaults, arg);
        var steps = this.length;

        return this.each(function() {
            elem_options = $(this).data();
            if(elem_options.tutorialStepPosition) options.position = elem_options.tutorialStepPosition;

            $tutorialStep = $('<div class="ui fluid popup tutorial step"></div>');
            if(options.inverted) {
                $tutorialStep.addClass('inverted');
            }

            isLastStep = elem_options.tutorialStep == steps;
            $fnDone = function(e) {
                $.cookie('tutorial', true);
                $popup = $(this).closest('.popup');
                $popup.popup('hide');
            }
            $btnDone = $('<div class="ui mini button">Okay, I\'m done!</div>').on('click', $fnDone);;
            $btnNext = $('<div class="ui mini button primary">'+((isLastStep) ? 'Done!' : 'Next')+'</div>');
            if(isLastStep) {
                $btnNext.on('click', $fnDone);
            }
            else {
                $btnNext.on('click', function(e){
                    $popup = $(this).closest('.popup');
                    nextStep = $popup.siblings('.tutorial').data('tutorial-step') + 1;
                    $popup.popup('hide');
                    $nextPopup = $('.tutorial[data-tutorial-step='+nextStep+']').popup('show');
                });
            }

            $('<h4 class="ui header">'+elem_options.tutorialStepTitle+'</h4>').appendTo($tutorialStep);
            $grid = $('<div class="ui grid">').appendTo($tutorialStep);
            $row = $('<div class="row"></div>').appendTo($grid);
            $column = $('<div class="column">'+elem_options.tutorialStepContent+'</div>').appendTo($row);
            $row = $('<div class="two column row"></div>').appendTo($grid);
            $column = $('<div class="column"></div>').appendTo($row);
            if(!isLastStep) $btnDone.appendTo($column);
            $column = $('<div class="column right aligned"></div>').appendTo($row);
            $btnNext.appendTo($column);

            $tutorialStep.insertAfter($(this));

            $(this).popup(options);
            if(elem_options.tutorialStep == 1) {
                $(this).popup('show');
            }
        });
    };
}( jQuery ));
