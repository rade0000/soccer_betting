1. Create mysql DB
2. insert into your DB core/betting.sgl;
3. populate core/init.php with your db info
4. create cronjob 
Minute	Hour	Day	Month	Weekday	Command
0	0	*	*	*	wget http://yoursite.com/add-points-to-users-every-day-cron-job.php

5. login in with user: admin password: admin




That is all.