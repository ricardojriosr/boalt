<p>Code Made by:</p>

<p>Ricardo Rios</p>
<p>ricardojriosr@gmail.com</p>
<p>7862470507</p>

1. Clone the repository
2. Change .env.example to .env and update the necesary data (eg: database username and connection)
3. Execute in the terminal "php artisan migrate"
4. Execute in the terminal "php artisan make:seeder UsersTableSeeder"
5. Use the REST API o the Web App to Register
6. Here are the Routes that use the REST API

    <p>POST '{project_url}/api/user/login', 'userDataRestController@api_user_login'); // Route for User Login in API</p>
    <p>POST '{project_url}/api/user/register', 'userDataRestController@api_user_register'); // Route for User Registration in API</p>
    <p>POST '{project_url}/api/user/logout', 'userDataRestController@api_user_logout'); // Route for User Login in API</p>
    <p></p>
    <p>Protected Route(s): for Users Info "must be logged in"</p>
    <p></p>
    <p>GET '{project_url}/api/user/info'  // Route to Grab User Info </p>
    <p>POST '{project_url}/api/yelp/api'  // Route to use External Yelp API</p>
    <p>POST '{project_url}/api/notification/new'  // Route to Create Notification</p>
    <p>GET '{project_url}/api/notification/show'  // Route to Show Notifications</p>
    <p>POST '{project_url}/api/notification/update'  // Route to Update Read/Unread Notifications</p>
    
7. Execute in the terminal "php artisan serve" to start the project
8. To delete all notifications "php artisan delete:notifications"
9. Postman file is inside Postman Folder
