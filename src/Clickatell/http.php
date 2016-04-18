<?php

/**
 * Set namespace
 */
namespace CodeChap\Sms\Clickatell;

/**
 * Web Socket Server
 */
class Http
{
  /**
   * Client object to work with
   */
  protected $baseUrl = "https://api.clickatell.com/http/sendmsg?";

  /**
   * Endpoint of url
   */
  protected $endpoint;

  /**
   * Construct
   *
   * @param Object The client class
   */
  public function __construct($client)
  {
    // Set url params
    $params = http_build_query(
      array(
        'user' => $client->config['username'],
        'password' => $client->config['password'],
        'api_id' => $client->config['api_id'],
        'text' => $client->text,
        'to' => implode($client->to, ',')
      )
    );

    // Set URL
    $this->endpoint = $this->baseUrl.$params;
  }

  public function execute()
  {
    // Send to api
    print file_get_contents($this->endpoint);
  }
}