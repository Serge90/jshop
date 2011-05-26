Variant.class_eval do
  def bare_code=(new_code)
    write_attribute(:bare_code, new_code)
  end
  
  def bare_code
    read_attribute(:bare_code)
  end
end