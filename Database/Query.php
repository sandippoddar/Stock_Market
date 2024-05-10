<?php

require_once __DIR__ . '/../Database/Connection.php';

/**
 * This class Implements all Database Queries that we have Used.
 */
class Query extends Connection {

  /**
   * This constructor use here to invoke parent class constructor.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Function to insert records when new User registered.
   * 
   * @param string $email
   *  Stores Email Id of new User.
   * @param string $password
   *  Stores Password in hash format.
   * 
   * @return void
   */
  public function insert(string $email, string $password) {
    $sql = $this->conn->prepare("INSERT INTO user (Email, Password) VALUES(:email, :password)");
    $sql->execute(array(':email' => $email, ':password' => $password));
  }

  /**
   * Function to check if Username or Email is already in the Database or not.
   * 
   * @param string $email
   *  Store Email Id of User.
   * 
   * @return string|bool
   *  This function returns String when Email is in Database and returns False 
   *  when Email is not in the Database.
   */
  public function Duplicate (string $email) {
    $sql = $this->conn->prepare("SELECT * FROM user WHERE Email = :email");
    $sql->execute(array(':email' => $email));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return 'Email has already Taken!!';
    }
    return False;
  }

  /**
   * Function to Check if the Email ID is already in the Database or not.It is 
   * using in Reset Password feature to send Reset Password Link.
   * 
   * @param string $userEmail
   *  Stores Email ID of the User.
   * 
   * @return bool
   *  This function return TRUE if Email ID is in the Database or return FALSE
   *  if Email ID is not in the Database.
   */
  public function isEmailInDb (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM user WHERE Email = :userEmail");
    $sql->execute([':userEmail' => $userEmail]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to Login user by checking the Email ID is Already
   * stored in the Database or not.
   * 
   * @param string $userEmail
   *  Stores the Data as per the User enter Username or Email.
   * 
   * @return int|bool
   *  This Function return Password of the User which Email is in the Database 
   *  or return False if User's Email is not in Database.
   */
  public function LoginSelect (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM user WHERE Email = :Email");
    $sql->execute(array(':Email' => $userEmail));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return $result['Password'];
    }
    return FALSE;
  }

  /**
   * Function to implement Insert stock records.
   * 
   * @param string $name
   *  Stores Stock Name.
   * @param int $price
   *  Stores Price Of the Stock.
   * @param string $email.
   *  Stores Email id of the User who Inserts the stock.
   * 
   * @return void
   */
  public function insertStock(string $name, int $price, string $email) {
    $date = date("Y-m-d H:i:s");
    $sql = $this->conn->prepare("INSERT INTO stock (Stock_Name, Stock_Price, CreatedTime, UpdatedTime, Email) VALUES(:name, :price, :date, :dateup, :email)");
    $sql->execute(array(':name' => $name, ':price' => $price, ':date' => $date, ':dateup' => $date, ':email' => $email));
  }

  /**
   * Function to fetch Stock details for a particular User.
   * 
   * @param string $email
   *  Stores Email Id Of User.
   * 
   * @return array
   *  Array contains Stock Details of a the Email User.
   */
  public function fetchStock(string $email) {
    $sql = $this->conn->prepare("SELECT * FROM stock WHERE Email = :Email");
    $sql->execute(array(':Email' => $email));
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to fetch all stock details.
   * 
   * @return array
   *  Array contains Stock Details of a the Email User.
   */
  public function fetchAllStock() {
    $sql = $this->conn->prepare("SELECT * FROM stock");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to implement Update Stock.
   * 
   * @param int $id
   *  Stores Id of Stock.
   * @param string $name
   *  Stores Stock Name.
   * @param int $price
   *  Stores Price of Stock.
   * 
   * @return void
   */
  public function updateStock(int $id, string $name, int $price) {
    $date = date("Y-m-d H:i:s");
    $sql = $this->conn->prepare("UPDATE stock SET Stock_Name = '$name', Stock_Price = $price, UpdatedTime = '$date' WHERE Stock_Id = $id");
    $sql->execute();
  }

  /**
   * Function to implement Delete a Stock.
   * 
   * @param int $id
   *  Stores Id of the User.
   * @param string $email
   *  Stores Email Id of User.
   * 
   * @return void
   */
  public function deleteStock(int $id, string $email) {
    $sql = $this->conn->prepare("DELETE FROM stock where Email = :email AND Stock_Id = :id");
    $sql->execute([':email' => $email, ':id' => $id]);
  }
}
