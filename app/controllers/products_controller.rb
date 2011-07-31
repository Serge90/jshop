class ProductsController < Spree::BaseController
  HTTP_REFERER_REGEXP = /^https?:\/\/[^\/]+\/t\/([a-z0-9\-\/]+)$/
  rescue_from ActiveRecord::RecordNotFound, :with => :render_404
  helper :taxons

  respond_to :html,:json
  before_filter :load_additional_params, :only=>[:show]

  def index
    @searcher = Spree::Config.searcher_class.new(params)
    @products = @searcher.retrieve_products

    respond_with(@products)
  end

  def show
    @product = Product.find_by_permalink!(params[:id])
    return unless @product

    @variants = Variant.active.includes([:option_values, :images]).where(:product_id => @product.id)
    @product_properties = ProductProperty.includes(:property).where(:product_id => @product.id)
    @selected_variant = @variants.detect { |v| v.available? }
    @reviews = @product.reviews

    referer = request.env['HTTP_REFERER']

    if referer && referer.match(HTTP_REFERER_REGEXP)
      @taxon = Taxon.find_by_permalink($1)
    end
    respond_with(@product)
  end

  def rate
    @product = Product.find_by_permalink!(params[:id])
    return unless @product
    @product.rate(params[:stars], current_user)
    @average = @product.rate_average(false)
    #@product.save!
    @width = (@average / @product.class.max_stars.to_f) * 100

    respond_to do |format|
      #format.html
      format.json
    end
  end

  def create_review
    @product = Product.find_by_permalink(params[:id])

    @review = Review.new
    @review.product = @product
    @review.user_id = current_user.id if user_signed_in?
    if @review.update_attributes(params[:review])
      flash[:notice] = t('review_successfully_submitted')
    #  redirect_to (product_path(@product))
    else
      flash[:notice] = 'There was a problem in the submitted review'
    #  render :action => "show"
    end
    redirect_to (product_path(@product))
  end

  protected
  def load_additional_params
    @review = Review.new
  end

  private

  def accurate_title
    @product ? @product.name : super
  end
end
