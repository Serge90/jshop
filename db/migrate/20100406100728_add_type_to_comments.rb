class AddTypeToComments < ActiveRecord::Migration
  def self.up
    add_column :comments, :comment_type_id, :integer
  end

  def self.down
    remove_column :comments, :comment_type_id
  end
end