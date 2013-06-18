$(document).ready(function(){
  $('#menu-uslugi > li ul')
    .click(function(event){
      event.stopPropagation();
    }).hide();
    
  $('#menu-uslugi > li').click(function(){
    var selfClick = $(this).find('ul:first').is(':visible');
    if(!selfClick) {
      $(this)
        .parent()
        .find('> li ul:visible')
        .slideToggle();
    }
    
    $(this)
      .find('ul:first')
      .stop(true, true)
      .slideToggle();
  });
});