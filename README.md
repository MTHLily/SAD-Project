**Quick Start Guide**

1. Open VS Code and the Terminal
2. Enter the following commands: 
3. git clone https://github.com/MTHLily/SAD-project.git
4. cd SAD-project
5. composer install
6. npm install
7. npm run dev
8. Copy and name .env.example to .env
9. Configure .env, DB_DATABASE="yourdatabasehere"
10. In pgadmin4 (for postgres), create a database with that name
11. php artisan key:generate
12. php artisan migrate:install
13. php artisan migrate:fresh
14. php artisan db:seed


**Update Guide**
1. Open the SAD-project folder in VS Code
2. In terminal:
3. git checkout master
4. git pull
5. npm run dev
6. Ready to start a new branch!


**Project Branching Guide**
1. Make sure to get the latest update from master. (See above)
2. In VS Code terminal:
3. git checkout -b *your-branch-name*
4. Make your changes/additions
5. git add .
6. git commit -m "*commit_message"
7. git push
    * If there's an error, use instead git push --set-upstream origin *your-branch-name*


**To Do List**
* Add Issues and remarks to components

**Useful Links, Resources and Keywords**
DataTables - datatables.net
SASS - better css everything. (Run with npm run watch)
