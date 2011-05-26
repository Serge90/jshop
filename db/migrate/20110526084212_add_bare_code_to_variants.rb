class AddBareCodeToVariants < ActiveRecord::Migration
  def self.up
    add_column :variants, :bare_core, :string
  end

  def self.down
    remove_column :variants, :bare_core
  end
end
