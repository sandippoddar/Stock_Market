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
      $apiKey = $_ENV['apiKey'];
      $client = new Client();
      $response = $client->request('GET', "https://emailvalidation.abstractapi.com/v1?api_key=$apiKey&email=$email");
      $data = json_decode($response->getBody(), TRUE);
      if ($data['deliverability'] === "DELIVERABLE" && !$data["is_disposable_email"]["value"]) {
        return TRUE;
      }
      return 'Email Does Not Exist!!';
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
  
  /**
   * Function to check given string is only Alphabets or not.
   * 
   * @param string $char
   *  Stores the String which is going to check if it has only Alphabets or not.
   * 
   * @return bool|string
   *  This function returns TRUE when it matches the given Regex and returns a
   *  String Message when it does not match the given Regex.
   */
  public function alphabetsOnly(string $char) {
    $pattern = '/^[A-Z a-z]+$/';
    if (preg_match($pattern,$char)) {
      return TRUE;
    }
    return "Stock Name should be only Alphabets!!";
  }

  /**
   * Function to check given Number is only Number or not.
   * 
   * @param string $num
   *  Stores the Number in string  which is going to check if it has only 
   *  Number or not.
   * 
   * @return bool|string
   *  This function returns TRUE when it matches the given Regex and returns a
   *  String Message when it does not match the given Regex.
   */
  public function numbersOnly(string $num) {
    $pattern = '/^[1-9][0-9]*$/';
    if (preg_match($pattern,$num)) {
      return TRUE;
    }
    return "Please Check Price Format Again!!";
  }
}
