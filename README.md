**Dependencies**
* php 7.4.8
* composer 1.10.9
* Laravel 7.x
* node 12.18.2
* npm 6.14.5
* PostgreSQL 12

**Quick Start Guide**

1. Open VS Code and the Terminal
2. Enter the following commands: 
3. git clone https://github.com/MTHLily/SAD-project.git
4. cd SAD-project
5. composer install
6. npm install
7. npm run dev
8. Copy and name .env.example to .env
9. Configure .env
 * DB_HOST and DB_PORT to the configuration of your postgres server.
 * DB_DATABASE to any empty database in postgres.
 * DB_USERNAME and DB_PASSWORD to your credentials for postgres
10. php artisan key:generate
11. php artisan migrate:install
12. php artisan migrate:fresh
13. php artisan db:seed
 * You can go to ~/database/seeds/DatabaseSeeder.php and comment out line 17 to disable the example seeds.
14. System should be up and running!

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

**Useful Links, Resources and Keywords**
DataTables - datatables.net
SASS - better css everything. (Run with npm run watch)
