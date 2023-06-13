### 1. Write an API endpoint

-   Here is the github link for the repository which contains endpoint to handle POST request for comments.
    https://github.com/ketankanhasoft/CommentManagment

### 2. You have a Pull Request to review!

-   The given code uses file_get_contents() to perform a GET request for the registration endpoint.
-   However, the documentation specifies that the endpoint should be accessed via the POST method, with the parameters included in the request body.
-   To resolve this, you can utilize the cURL library, which enables sending a POST request with the parameters in the request body.
-   The response is obtained, JSON is decoded, and the token information is stored in the $tokenInfo variable.

Please customize the code according to your specific requirements and ensure that the cURL library is enabled in your PHP environment.

### 3. Legacy code refactoring

##### Here is the explaination for the redfactor which is needed ::

-   Need to initialize $masterEmail variable to an empty string outside the if condition.
-   The ternary condition seems to be bit longer then needed, need to simplify the same
-   Here, we need to use mysqli_fetch_assoc() instead of mysqli_fetch_row() to fetch the row as an associative array, also this will allow you to access columns by their names.

##### Here is the refactored code ::

```php
$masterEmail = '';
if (isset($_REQUEST['email'])) {
	$masterEmail = $_REQUEST['email'];
}
$masterEmail = $masterEmail ?: (isset($_REQUEST['masterEmail']) && $_REQUEST['masterEmail'] ? $_REQUEST['masterEmail'] : 'unknown');
echo 'The master email is ' . $masterEmail . '\n';
$conn = mysqli_connect('localhost', 'root', 'sldjfpoweifns', 'my_database');
$res = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $masterEmail . "'");
$row = mysqli_fetch_assoc($res);
echo $row['username'] . "\n";
```

### 4. Open source libraries

-   The decision to use a class or library provided by an external framework should be based on a careful evaluation of the specific requirements and considerations of your project.
-   It is essential to weigh the benefits and potential drawbacks before making a decision.
-   If the class or library addresses a specific need or solves a particular problem in your project, it can be beneficial to leverage it.
-   If the library or class is not compatible with our existing code, we should not change anything which is currently working in our system. Because that change might break our working functionality.
