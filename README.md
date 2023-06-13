### Endpoint to handle POST request for comments

-   I have prepared an endpoint in Laravel to handle the POST request and will store comment in database, also will respond with a proper response code.
-   I've used `Laravel 10.10` which is running on `PHP 8.2`.
-   In database I have used `MySQL`.

##### In order to setup the project you will be required to follow below steps

1. Get a clone from the repository
2. Go to project root directory.
3. Run `composer install`
4. Run `php artisan migrate`
5. To run the server `php artisan serve`

The endpoint will be something like `{host}/api/comments`, will accept the parameters like,

-   client_id (Required and valid UUID only)
-   email (Required and valid email format only)
-   phone_number (Not required but if passed then digits between 10 to 15)
-   name (Required and String only)
-   comment (Required, String and maximum 1000 characters)

I have also prepared test to validate both type of inputs as in valid inputs and non valid inputs. To run the tests you will be required to run `php artisan test` command
