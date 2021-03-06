module ApplicationHelper
  # to create menu in the header
  def special_menu_creator
    links = {:homepage => root_path,
             :whats_new => news_index_path,
             :specials => "#",
             :contact_us => contact_index_path
    }
    if session['warden.user.user.key'].nil?
      links["login"] = login_path
    else
      links["logout"] = {:action=>"destroy", :controller=>"/user_sessions"}
    end
    i = 0
    links.collect do |name,to_go|
      request
      "<td id=\"#{"over_" if request.url.eql?(to_go)}m#{i+=1}\" onMouseOut=\"this.id='#{"over_" if request.url.eql?(to_go)}m#{i}';\" onMouseOver=\"this.id='over_m#{i}';\">
          #{link_to t(name), to_go}
		  </td>"
    end.join("<td class=\"menu_separator\"><img src=\"/images/menu_separator.gif\" border=\"0\" alt=\"\" width=\"1\" height=\"13\"></td>").html_safe
  end

  def header_menu_creator links
    links.collect do |name,to_go|
      "<li>#{link_to t(name), to_go}</li>"
    end.join('').html_safe
  end
  
  #loads locales for language module
  def get_locales
    fall_back = [:ru].to_yaml
    locales = CustomSetting.find_or_create_by_name("languages").value || fall_back
    begin
      locales = YAML::load(locales)
    rescue
      locales = YAML::load(fall_back)
    end
  end
end
