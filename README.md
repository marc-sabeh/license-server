
## About The project 
 We Firstly added the user table which holds a license info id which directs to the key bought
 You can buy the license key using the views of Laravel you should be signed up and signin to be able to do that 
 You can choose which one you want and then the equiments you want with it depends on which one you are choosing 

If we want to add a new license feature it can be added directly 
though they should be added in the database table license_features

After buying the license there should be a cron tab which can be called by php artisan schedule:work
to make sure the license is still valid it should be running everyminute when the license is invalid then the user will be able to do buy a new license 
as each user gets only one license 
This is the command that is called in the corn php artisan Validate:cron



