class VariableSettingsHooks < Spree::ThemeSupport::HookListener
  # custom hooks go here
  insert_after :admin_tabs do
    %(<%= tab(:custom_settings) %>)
  end
  
  insert_after :inside_head do
    %(
<link type="text/css" rel="stylesheet" media="screen" href="/stylesheets/dd.css"/>
<%= javascript_include_tag 'jquery.dd.js' %>
)
  end
end