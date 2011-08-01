(function($){
  $(document).ready(function(){

    // Remove an item from the cart by setting its quantity to zero and posting the update form
    $('form#updatecart a.delete').show().live('click', function(e){
      $(this).parents('tr').find('input.line_item_quantity').val(0);
      $(this).parents('form').submit();
      e.preventDefault();
    });

    $(function(){
        $('#slides').slides({
            preload: true,
            preloadImage: 'images/loading.gif',
            play: 6000,
            pause: 250,
            hoverPause: true
        });
    });

    $("ul.dropmenu").superfish({
        animation: {height:'show'},   // slide-down effect without fade-in
        delay: 1500,
        dropShadows: false
    });

    $("ul.sidebar-dropmenu").superfish({
        animation: {height:'show'},   // slide-down effect without fade-in
        delay: 1500,
        dropShadows: false
    });

    $(".first-level").mouseover(function(){
        $(this).addClass('first-level-active');
    });
    $(".first-level").mouseout(function(){
        $(this).removeClass('first-level-active');
    });

    $( "#tabs" ).tabs();
   //$('.star').rating();

  });
})(jQuery);



function bookmark_us(url, title){

if (window.sidebar) // firefox
    window.sidebar.addPanel(title, url, "");
else if(window.opera && window.print){ // opera
    var elem = document.createElement('a');
    elem.setAttribute('href',url);
    elem.setAttribute('title',title);
    elem.setAttribute('rel','sidebar');
    elem.click();
}
else if(document.all)// ie
    window.external.AddFavorite(url, title);
}
