<?php
require './vendor/autoload.php';
require_once './Creds/DotEnvHandler.php';
use GuzzleHttp\Client;

/**
 * This class represents to validate every input field.
 */
class Validation extends DotenvHandler {

  public function __construct() {
    $this->dotEnv();
  }

  /**
   * Function to validate Email either it exist or not.
   * 
   * @param string $email
   *  Stores Email Id of user.
   * 
   * @return bool|string
   */
  public function isValidMail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    }
    return 'Please Check!! Incorrect Email Format.';
  }

  /**
   * Function to set the password has maximum length 20 and minimum length has 
   * 5 characters.
   * 
   * @param string $pass
   *  Stores Password of User.
   * 
   * @return bool|string
   */
  public function isPassword($pass) {
    $passLength = strlen($pass);
    if ($passLength < 5) {
      return 'Password must contain at least 5 character';
    }
    elseif ($passLength > 50) {
      return 'Password can be maximum of 50 character';
    }
    return TRUE;
  }
}
