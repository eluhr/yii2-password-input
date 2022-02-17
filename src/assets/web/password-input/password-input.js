$.fn.passwordInput = function (options) {
    options = options || {};
    var _input = $(this);
    var _widget = _input.closest('.password-input-widget');
    var _button = _widget.find('.password-input-toggle-button');
    var _ruleBars = _widget.find('.password-rule-bars');
    var _ruleTexts = _widget.find('.password-rule-texts');
    var _rules = options.rules || []

    _input.on("input", function () {
        var inputValue = $(this).val();
        for (var ruleIndex = 0; ruleIndex < _rules.length; ruleIndex++) {
            checkBar(ruleIndex, inputValue)
            checkText(ruleIndex, inputValue)
        }
    });

    function checkBar(ruleIndex, inputValue) {
        var rule = _rules[ruleIndex]
        var ruleBar = _ruleBars.find('.password-rule-bar:nth-of-type(' + (ruleIndex + 1) + ')');
        var isValid = patternMatches(inputValue, rule.pattern)
        if (isValid) {
            ruleBar.addClass('matches');
        } else {
            ruleBar.removeClass('matches');
        }
    }

    function checkText(ruleIndex, inputValue) {
        var rule = _rules[ruleIndex]
        var ruleText = _ruleTexts.find('.password-rule-text:nth-of-type(' + (ruleIndex + 1) + ')');
        var isValid = patternMatches(inputValue, rule.pattern)
        if (isValid) {
            ruleText.addClass('matches');
        } else {
            ruleText.removeClass('matches');
        }
    }

    function patternMatches(text, pattern) {
        var regEx = new RegExp(pattern.replaceAll('\/', ''));
        return text.match(regEx) !== null
    }

    _button.on("click", function () {
        var button = $(this);
        var oldVisibility = button.data("password-visible");
        var newVisibility = oldVisibility ? 0 : 1;
        button.data("password-visible", newVisibility)

        if (newVisibility === 1) {
            button.button('visible')
            _input.attr('type', 'text')
        } else {
            button.button('hidden')
            _input.attr('type', 'password')
        }
    })
}
