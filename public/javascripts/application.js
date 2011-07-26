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

  });
})(jQuery);
