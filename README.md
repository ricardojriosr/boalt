Code Made by:

Ricardo Rios
ricardojriosr@gmail.com
7862470507

1. Clone the repository
2. Change .env.example to .env and update the necesary data (eg: database username and connection)
3. Execute in the terminal "php artisan migrate"
4. Execute in the terminal "php artisan make:seeder UsersTableSeeder"
5. Use the REST API o the Web App to Register
6. Here are the Routes that use the REST API

    POST '{project_url}/api/user/login', 'userDataRestController@api_user_login'); // Route for User Login in API
    POST '{project_url}/api/user/register', 'userDataRestController@api_user_register'); // Route for User Registration in API
    POST '{project_url}/api/user/logout', 'userDataRestController@api_user_logout'); // Route for User Login in API

    Protected Route(s): for Users Info "must be logged in"

    GET '{project_url}/api/user/info'  // Route to Grab User Info 
    POST '{project_url}/api/yelp/api'  // Route to use External Yelp API
    POST '{project_url}/api/notification/new'  // Route to Create Notification
    GET '{project_url}/api/notification/show'  // Route to Show Notifications
    POST '{project_url}/api/notification/update'  // Route to Update Read/Unread Notifications

7. Execute in the terminal "php artisan serve" to start the project
8. To delete all notifications "php artisan delete:notifications"
9. Postman file is inside Postman Folder
