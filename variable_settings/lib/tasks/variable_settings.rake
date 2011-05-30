# add custom rake tasks here
namespace :products do
  desc "Exports the products"
  task :export => :environment do
    csv = "\"id\";\"sku\";\"name\";\"description\";\"count_on_hand\";\"option_names\";\"options\";\"price\";\"cost_price\";\"barcode\";\n"
    Product.all.each do |product|
      product.variants.each do |variant|
	csv << "\"#{product.id}\";\"#{variant.sku}\";\"#{product.name}\";\"#{product.description}\";\"#{product.count_on_hand}\";"
	csv << "\"" + variant.option_values.map{|ov| ov.option_type.name}.join(",") + "\";"
	csv << "\"" + variant.option_values.map(&:name).join(",") + "\";"
	csv << "\"#{variant.price}\";\"#{variant.cost_price}\";\"#{variant.barcode}\";"
	csv << "\n"
      end

      if product.variants.size < 1
        csv << "\"#{product.id}\";\"#{product.sku}\";\"#{product.name}\";\"#{product.description}\";\"#{product.count_on_hand}\";"
	csv << "\"\";\"\";" # options
	csv << "\"#{product.price}\";\"#{product.cost_price}\";;"
	csv << "\n"
      end
    end
    
    # write data into the file
    file = File.open(File.join(Rails.root,"public","export.csv"), "w")
    file.syswrite(csv)
    file.close
  end

  desc "Imports the products from file public/import.csv"
  task :import => :environment do
    # TODO: put default values
    p "TODO: put default values"
    tax_category_id = nil
    shipping_category_id = nil

    require 'csv'
    CSV.read(File.join(Rails.root, 'public', 'import.csv'), {:headers => :first_row, :col_sep => ","}).each do |row|
      if row["id"]
	product = Product.find(row["id"])
      else
	variant = Variant.find_by_sku(row["sku"])
	if variant
	  product = variant.product
	else
	  product = Product.new
	end
      end
      
      product.name = row["name"].force_encoding("utf-8")
      product.description = row["description"].force_encoding("utf-8")
      product.sku = row["sku"].force_encoding("utf-8")


      #if no variant yet, we should set master price to product
      unless variant
	product.price = row["price"]
	product.cost_price = row["cost_price"]
	product.count_on_hand = row["count_on_hand"]
	product.available_on = Time.now
	product.tax_category_id = tax_category_id
	product.shipping_category_id = shipping_category_id
      end
      
      # creating options and values
      options = row['options'].split(',').map{|el| el.strip}
      option_names = row['option_names'].split(',').map{|el| el.strip}
      variant_values = []

      option_names.each_with_index do |option_name, index|
	option = OptionType.find_by_name option_name
	unless option
	  option = OptionType.new(:name => option_name, :presentation=>option_name)
	  option.save!
	end

	if option_value = option.option_values.select{|option_value| option_value.name.eql?(options[index].force_encoding("utf-8"))}.first
	  variant_values << option_value
	else
	  option_value = option.option_values.create(:name => options[index], :presentation => options[index])
	  option_value.save!
	  variant_values << option_value
	end
	product.option_types += [option] unless product.option_type_ids.include?(option.id)
      end
      product.save!

      #creating variants
      if variant = product.variants.select{|variant| variant.barcode.eql?(row["barcode"].force_encoding("utf-8"))}.first
	variant
      else
	variant = product.variants.create(:barcode => row["barcode"].force_encoding("utf-8"))
	variant.barcode = row["barcode"].force_encoding("utf-8")
      end
      variant.sku = row["sku"].force_encoding("utf-8")
      variant.price = row["price"]
      variant.cost_price = row["cost_price"]
      variant.count_on_hand = row["count_on_hand"]
      variant.option_values = variant_values
      p "Variant not saved" unless variant.save!
      product.save!

      #adding taxons to product
      row['taxonomy'] = row['taxonomy'].force_encoding("utf-8")
      row['taxons']   = row['taxons'].force_encoding("utf-8")
      if taxonomy = Taxonomy.find_by_name(row['taxonomy'])
	taxonomy = taxonomy.first if taxonomy.is_a?(Array)
      else
	taxonomy = Taxonomy.new(:name=>row['taxonomy'])
	taxonomy.save!
      end
      row['taxons'].split(',').each do |taxon|
	#checking 
        o_taxon = Taxon.where(:name => taxon.strip, :taxonomy_id => taxonomy.id)
	o_taxon = o_taxon.first
	p o_taxon
        unless o_taxon
          o_taxon = Taxon.new(:name=>taxon.strip, :taxonomy_id => taxonomy.id)
          o_taxon.save!
        end
        product.taxons += [o_taxon] unless product.taxon_ids.include?(o_taxon.id)
      end


      #translations
      I18n.locale = :ru
      product.name = row["name"].force_encoding("utf-8")
      product.description = row["description"].force_encoding("utf-8")
      product.save!

    end
  end
end