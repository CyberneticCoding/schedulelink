# ScheduleLink  

ScheduleLink is application that allows for calendar/scheduling functionality. It that allows users within a team or company to quickly find the available time of selected users and plan a meeting in record time.  

# Tech Stack  
This application uses Laravel, Vue3, Inertiajs and TailwindCSS. Together with fontawesome for icons, ESLint as a linter and PostgreSQL for database  

# Installation  

**Install PostgreSQL**  
Make sure you have have downloaded postgreSQL. https://www.postgresql.org/download/  
remove ; from extension=pdo_pgsql in php.ini  
Create an empty database named schedulelink  

**Install the application**  
`git clone https://github.com/CyberneticCoding/schedulelink.git`  
`cd schedulelink`  
`npm install`  
`composer install`  

**Setup .env**   
Copy the .env.example and rename it .env  
Setup your PostgreSQL database and change the .env information.  
In your .env, change DB_HOST to 127.0.0.1  

**Run the application**  
`php artisan key:generate` Do this one time at the beginning  
Open 2 terminals and run these commands in each another terminal. Keep them running.  
`php artisan serve`  
`npm run dev`  

# Github Rules  
Before going to work, make sure you are on the main branch and have done `git pull`  
Create a new feature branch and checkout to that branch `git checkout -b "feature/example-feature"`  
Go to work. Work in small commits A commit is done like:  
`git add .`  
`git commit -m "description of the commit"`  
After you have done all your commits and you are ready to push your changes.  
`git push origin feature/example-feature`  
Now the pipeline will run the tests and hopefully the branch is ready to be merged.  

**Testing**  
Before pushing and merging code, run the tests locally first.  
Run feature tests with `php artisan test`  
Run Dusk's e2e tests with `php artisan dusk`  
Always test your feature by hand before pushing and merging.  

# Definition of Done 
* Everything that has a design, needs to be fully responsive for desktop(w=2000px), tablet and phone (w=300px)
* Each user story needs to be reviewed by the other developer before being merged with master.
* Each new feature needs to have tests (if applicable).
* Each new feature should result in all test cases succeeding.
