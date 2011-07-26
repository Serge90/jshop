class DelayedRakeTask
  def initialize(task_name)
    @task_name = task_name
  end
  
  def perform
    Rake::Task[@task_name].invoke
  end
end

namespace :solr do
  namespace :async do

    task :reindex => :environment do
      Delayed::Job.enqueue DelayedRakeTask.new('solr:reindex')
    end

    task :optimize => :environment do
      Delayed::Job.enqueue DelayedRakeTask.new('solr:optimize')
    end

  end
end 
