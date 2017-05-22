'use strict';

var test = ['ES6', 'language', 'features!'];
test.map(function (word) {
  return console.log(word);
});

var jQueryTest = ['Or', 'just', 'jQuery'];

(function ($) {
  $(document).ready(function () {
    $.each(jQueryTest, function () {
      console.log(this);
    });
  });
})(jQuery);