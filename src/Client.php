<?php

/**
 * Set namespace
 */
namespace CodeChap\Sms;

/**
 * Web Socket Server
 */
class Client
{
  /**
   * Base configuration
   *
   * @var Array Configuration array to use
   */
  public $config = array(
    'username' => '',
    'password' => '',
    'api_id' => ''
  );

  /**
   * Numbers to sms to
   *
   * @var Array An array of numbers to sms to
   */
  public $to = array();

  /**
   * The message
   *
   * @var String The message string
   */
  public $text = null;

  /**
   * Sets up the class object
   */
  public function __construct(array $config = array())
  {
    // Order is important - do not change
    $this->config = array_merge($this->config, $config);
  }

  /**
   * Sets the numbers to sms
   */
  public function to($to)
  {
    // Convert to an array if needed
    if( ! is_array($to) ){
      $to = array($to);
    }
      
    // Loop and validate each number
    foreach($to as $number){
      $this->to[] = preg_replace('/\D/', '', $number);
    }
  }

  /**
   * Test the text / body of the message 
   */
  public function body($text)
  {
    $this->text = $text;
  }

  public function send()
  {
    // Send away
    $transport = new Clickatell\Http($this);
    $result = $transport->execute(); 

    return $result;  
  }
}
