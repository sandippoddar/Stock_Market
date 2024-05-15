<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

/**
 * This class represents to use Dotenv class.
 */
class DotEnvHandler {

  /**
   * @var Dotenv $dotenv
   * 
   * Stores Functionality of Dotenv class to use $_ENV variables.
   */
  private $dotenv;

  /**
   * This function uses here to store Dotenv Functionalities in instance member
   * $dotenv.
   * 
   * @return void
   */
  public function dotEnv() {
      $this->dotenv = Dotenv::createImmutable(__DIR__);
      $this->dotenv->load();
  }
}
