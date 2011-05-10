class Admin::CustomSettingsController < Admin::BaseController
  resource_controller
  
  private
    create.wants.html { redirect_to admin_custom_settings_url}
    update.wants.html { redirect_to admin_custom_settings_url}
      def collection
        @collection ||= end_of_association_chain.paginate :page => params[:page], :order => 'created_at DESC'
      end
end