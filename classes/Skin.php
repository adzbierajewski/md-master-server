<?php

/**
 * Class skins
 * handles the uploading and viewing of skins
 */
class Skin
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
      session_start();
        if (isset($_FILES["skin"])) {
          session_start();
            $this->uploadSkin($_SESSION[""]);
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function uploadSkin($name)
    {
        if (empty($_FILES["skin"])) {
            $this->errors[] = "There was no file attached";
        }
      //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['skin']['name']);
  //$ext = substr($filename, strrpos($filename, '.') + 1);
  if(($_FILES["skin"]["type"] == "image/png") && ($_FILES["skin"]["size"] < 1000000)) {
    //Determine the path to which we want to save this file
      $newname = '/usr/share/nginx/html/skins_manicdigger/' . $_SESSION['user_name'] . '.png'; //needs esacaped?
      //Check if the file with the same name is already exists on the server
      unlink($newname);
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['skin']['tmp_name'],$newname))) {
           $this->messages[] = "Your skin was updated.";
        } else {
           $this->errors[] = "A problem occured during upload.";
        }
  } else {
     $this->errors[] = "Error: Only .png images under 1Mb are accepted for skins";
  }
}
}