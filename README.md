## Laravel Github Api
Simple PHP Api using Laravel, Redis, MySQL, and Github User Api.
### Requirements
- Laravel
- Redis
- MySQL

### Project Setup
Create a `.env` file on the root directory by this command.
```bash
# This will create a .env file from .env.example.
cp .env.example .env
```
You must update the variables according to your `MySQL` and `Redis` setup on your machine.
```
# This is for MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=password

# This is for Redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```
### Dependencies and Migration
Install dependencies and migrate using this commands.
```bash
# Install Dependencies
$ composer update

# DB Migration, this will create a migration to MySQL for user authentication
$ php artisan migrate

```
### Running the Server
After all dependencies and migration is done, run the server using this command.
```bash
# Running the server on port 8000
$ php artisan serve
```

### Log File
You can check for the logs on /storage/logs/laravel.logs
### Testing the Endpoints
For postman, you need to have a headers to have a successful request. Please enter this `key` `value` pair on your headers.
```
Authorization: Bearer {token}
Accept: application/json
```
You can get the `token` part of the `Authorization` from the response of a successful register or login.
#### Register
```
method: POST
url: http://localhost:8000/api/register
# Sample body
{
    "name": "Test"
    "email": "test@gmail.com",
    "password": "test",
    "password_confirmation": "test"
}
# Sample response
{
    "user": {
        "id": 1,
        "name": "Test",
        "email": "test@gmail.com",
        "email_verified_at": null,
        "created_at": "2021-08-09T08:17:41.000000Z",
        "updated_at": "2021-08-09T08:17:41.000000Z"
    },
    "token": "1|Av3qAVB71vsiwvozl8FOk6vkPC7mxMgB8DFS719X"
}
```
#### Login
```
method: POST
url: http://localhost:8000/api/login

# Sample body
{
    "email": "test@gmail.com",
    "password": "test"
}
# Sample response
{
    "user": {
        "id": 1,
        "name": "Test",
        "email": "test@gmail.com",
        "email_verified_at": null,
        "created_at": "2021-08-09T08:17:41.000000Z",
        "updated_at": "2021-08-09T08:17:41.000000Z"
    },
    "token": "1|Av3qAVB71vsiwvozl8FOk6vkPC7mxMgB8DFS719X"
}
```
#### Logout
```
method: POST
url:  http://localhost:8000/api/logout
```
#### GET Welcome Message
```
method: GET
# This is just for testing if GET request works
url:  http://localhost:8000/api/github
```
#### POST Github Usernames
```
method: POST
url:  http://localhost:8000/api/github
# Sample body (You can add up to a maximum of 10 usernames)
{
    "usernames": [
        "jason",
        "mojombo"
    ]
}
# Sample Response
[
    {
        "name": "Jason",
        "login": "jason",
        "company": "",
        "followers": 16,
        "public_repos": 43,
        "ave_followers_per_repos": 0.37209302325581395
    },
    {
        "name": "Tom Preston-Werner",
        "login": "mojombo",
        "company": "@chatterbugapp, @redwoodjs, @preston-werner-ventures ",
        "followers": 22621,
        "public_repos": 62,
        "ave_followers_per_repos": 364.85483870967744
    }
]
```
The `response` will be cached on Redis for `2 minutes`. If another username is fetched that is not from the cached, it will request on the github url here `https://api.github.com/users/{username}`, else it will request from Redis.

Please note to always check the Logs on this file, `/storage/logs/laravel.log`.