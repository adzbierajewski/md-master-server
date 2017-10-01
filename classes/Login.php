<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT user_name, user_password_hash
                        FROM users
                        WHERE user_name = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    //TODO: Handle legacy logins (do not allow login but require changing the password in advance)

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        //Update 'last_login' field
                        $sql = "UPDATE users
                                SET last_login = NOW()
                                WHERE user_name = '" . $result_row->user_name . "';";
                        $query_update_login_date = $this->db_connection->query($sql);

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_login_status'] = 1;

                        // return a little feeedback message
                        $this->messages[] = "Login successful.";

                    } else {
                        $this->errors[] = "Wrong password. Try again."; //TODO: This might be a security risk?
                    }
                } else {
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL,"http://manicdigger.sourceforge.net/play/login.php");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);     
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            'username=' . $_POST['user_name'] . '&password=' . $_POST['user_password'] . '&server=9c1d22eac9aac5f36bf12a5fb5c8a856');

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
if(!(preg_match('/ERROR/',$server_output))) {
    header("Location: /register?import=true&username=" . $_POST['user_name']);
} else {
    $this->errors[] = "This user does not exist.";
}
curl_close ($ch);
                    //$this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
