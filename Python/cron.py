from crontab import CronTab

cron = CronTab(user='root')

job = cron.new(command='python ~/aquarium_files/Python_Mcmahon/feed.py', comment='test')  
job.minute.every(1)

cron.write()

print job.enable()  
print job.enable(False)
