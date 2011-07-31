ReviewsController.class_eval do
  def create
    @review = Review.new(params[:id])
    @review.save

  end
end