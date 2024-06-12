<?php
date_default_timezone_set('Europe/Paris');
class Message {

  private string $pseudo;
  private string $message;
  private DateTime $date;

  public function __construct(string $pseudo, string $message, DateTime $date = null)
  {
    $this->pseudo = $pseudo;
    $this->message = $message;
    $this->date = $date ?? new DateTime();
  }

  public function isValid() : bool
  {
    if (strlen($this->pseudo) < 3)
        return false;
    else if (strlen($this->message) < 10)
        return false;
    else
        return true;
  }

  public function getErrors() : array
  {
    $errors = [];
    if (strlen($this->pseudo) < 3)
        $errors['pseudo'] = "Le pseudo doit contenir au moins 3 caractères";
    if (strlen($this->message) < 10)
        $errors['message'] = "Le message doit contenir au moins 10 caractères";
    return $errors;
  }

  public function to_html() : string
  {
      return '<p><strong>' . $this->pseudo . '</strong> a écrit le ' . $this->date->format('d/m/Y à H:i') . ' :<br>' . $this->message . '</p>';
  }

  public function toJSON() : string
  {
    return json_encode([
      'pseudo' => $this->pseudo,
      'message' => $this->message,
      'date' => $this->date->getTimestamp()
    ]);
  }

}