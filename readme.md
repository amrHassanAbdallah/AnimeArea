
## This Project is build wih laravel 


####to install the project
So to get the things setup you should have a server runing with mysql too put the project files  where your server start most of time if you using xampp would be in htdocs inside xampp folder , any way start with creating database let's call it AnimeArea , after creating it go to AnimeArea project files in the root directory will find a file called .env this one contains your site details ,set your DB_DATABASE to be equal to your database name and DB_USERNAME if you didn't create specific user would be root and DB_PASSWORD would be empty . 


Congrats now you are up and runing with AnimeArea Site .

###code
Write in your terminal in the project folder 

php artisan migrate -> which will install all project tables in your db 
php artisan db:seed  -> which will seed your db with 30 products and 10 users of type customer and 1 admin of type seller 
####features 
Observer , decorator patterns applied .
also couple unit testing there . 