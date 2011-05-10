class CreatePromotedItems < ActiveRecord::Migration
def self.up
create_table :promoted_items do |t|
t.string :description
t.references :product
t.date :start
t.date :stop
end
end

def self.down
drop_table :promoted_items
end
end
