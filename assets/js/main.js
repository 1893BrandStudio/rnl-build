let test = ['ES6', 'language', 'features!']
test.map(word => console.log(word))

var jQueryTest = ['Or', 'just', 'jQuery'];

(function($){
  $(document).ready(function(){
    $.each(jQueryTest, function(){
      console.log(this);
    });
  });
})(jQuery);
