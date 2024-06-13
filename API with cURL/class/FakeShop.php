<?php
class FakeShop {

  private $api;

  private $articles = [];

  public function __construct(string $API) {
    $this->api = $API;
  }

  public function getArticles() {
    $ch = curl_init($this->api);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    if ($data === false)
      var_dump(curl_error($ch));
    else
    {
      $this->articles = json_decode($data, true);
    }
    curl_close($ch);
    return $this->articles;
  }

  public function articlesToHTML(array $article)
  {
    return ' 
    <div class="card" style= "width:200px;height:300px">
    <div class="col">
      <img src="' . $article['image'] . '" style="width: 150px; height:150px;" alt="...">
      <div class="card-body">
        <p><b><u>' . substr($article['title'], 0, 10) . '...' . '</b></u></p>
        <p style="font-size:12px">' . substr($article['description'], 0, 30) . '...' . '</p>
        <p><b>' . $article['price'] . '€</b></p>
      </div></div></div>';
  }

}