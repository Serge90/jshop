Product.class_eval do
  ajaxful_rateable :stars => 5
end

#ProductsController.class_eval do
#def rate
#    @product = Product.find(params[:id])
#    @product.rate(params[:stars], current_user, params[:dimension])
#    average = @product.rate_average(true, params[:dimension])
#    width = (average / @product.class.max_stars.to_f) * 100
#    render :json => {:id => @product.wrapper_dom_id(params), :average => average, :width => width}
#  end
#end