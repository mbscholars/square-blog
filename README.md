# Simple Blog

This software fetches post from an api to deliver blog contents and also provides a simple admin interface to create new blog contents


## Setup

After cloning the repository, run the command:

```bash
composer install
```
Copy the contents of .env.example to .env

```bash
cp .env.example .env
```

Optionally, you can change the administrator email in the env file

```bash
SQUARE_ADMIN_EMAIL=youremail@example.com
```

You can also change other options such as the number of posts to show in a page and specify if you want to use http mocks while testing

```bash
SQUARE_POSTS_PER_PAGE=6 
SQUARE_USE_TEST_MOCKS=true
```
 
Run Migrations:

```bash
php artisan migrate 
```

Perform initial setup:

```bash
php artisan blog:setup 
```
This command would setup login credentials for administrator, take note of the password generated as you would need it to login

## Testing

```bash
php artisan test
```

ASSETS 
- Writing icons created by Freepik - Flaticon [https://www.flaticon.com/free-icons/writing] 
- 
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
