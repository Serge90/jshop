module LocalesHelper
  def get_locales
    fall_back = [:en].to_yaml
    locales = CustomSetting.find_or_create_by_name("languages").value || fall_back
    begin
      locales = YAML::load(locales)
    rescue
      locales = YAML::load(fall_back)
    end
  end

  def flag_image(code)
    "#{code.to_s.downcase}.png"
  end
end 
