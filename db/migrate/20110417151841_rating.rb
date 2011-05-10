class Rating < ActiveRecord::Migration
  def self.up
    create_table :ratings do |t|
      t.string  :product
      t.float   :value
      t.integer :count
      t.timestamps
    end
  end

  def self.down
    drop_table :ratings
  end
end
