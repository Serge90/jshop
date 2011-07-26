class CreateCustomSettings < ActiveRecord::Migration
  def self.up
    create_table :custom_settings do |t|
      t.string :name
      t.text :value
      t.boolean :destroyable
      t.text :scoping
      t.text :from_value_type

      t.timestamps
    end
  end

  def self.down
    drop_table :custom_settings
  end
end
