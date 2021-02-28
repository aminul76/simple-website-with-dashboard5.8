POS System Using Laravel
The project was created while recording video "Create POS System Using Laravel"

Installation
Requirements
For system requirements you Check Laravel Requirement

Clone the repository from github.
git clone https://github.com/angkosal/laravel-pos.git [YourDirectoryName]
The command installs the project in a directory named YourDirectoryName. You can choose a different directory name if you want.

Install dependencies
Laravel utilizes Composer to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

cd YourDirectoryName
composer install
Config file
Rename or copy .env.example file to .env 1.php artisan key:generate to generate app key.

Set your database credentials in your .env file
Set your APP_URL in your .env file.
Database
Migrate database table php artisan migrate
Generate config php artisan db:seed
Install Node Dependencies
npm install to install node dependencies
npm run dev to build our javascript
Create Admin Account
php artisan tinker and than paste
App\Models\User::create([
    'first_name' => 'Admin',
    'last_name' => 'admin',
    'email'=>'admin@gmail.com',
    'password' => bcrypt('admin')
]
hit enter.
Create storage link
php artisan storage:link

Run Server
php artisan serve or Laravel Homestead
Visit localhost:8000 in your browser
Visit /admin if you want to access the admin. Email: admin@gmail.com, Password: admin.
