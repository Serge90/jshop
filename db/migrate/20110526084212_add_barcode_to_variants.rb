class AddBarcodeToVariants < ActiveRecord::Migration
  def self.up
    add_column :variants, :barcode, :string
  end

  def self.down
    remove_column :variants, :barcode
  end
end
