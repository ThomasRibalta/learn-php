<?php
require_once 'Message.php';
date_default_timezone_set('Europe/Paris');

class GoldBook {

  private array $messages = [];
  private string $file;

  public function __construct(string $file)
  {
    $this->file = $file;
    if (!file_exists($file))
    {
      $handle = fopen($file, 'w');
      fclose($handle);
    }
  }

  public function addMessage(Message $message) : void
  {
    $handle = fopen($this->file, 'a');
    if ($handle) {
      fwrite($handle, $message->toJSON() . PHP_EOL);
      fclose($handle);
    } else {
      echo "Error opening the file for writing.";
    }
  }

  public function getMessages() : array
  {
    $handle = fopen($this->file, 'r');
    if ($handle) {
      while (($line = fgets($handle)) !== false) {
        $data = json_decode($line, true);
        if ($data) {
          $this->messages[] = new Message($data['pseudo'], $data['message'], new DateTime('@' . $data['date']));
        }
      }
      fclose($handle);
    } else {
      echo "Error opening the file for reading.";
    }
    return $this->messages;
  }
}
