<?php
namespace App;

class URLManager
{
    public static function makeURL(array $params = [], array $newParams = []) : string
    {
      $url = '?';
      if (!empty($params))
      {
        foreach ($params as $key => $value)
        {
          if (!isset($newParams[$key]))
            $url .= $key . '=' . $value . '&';
        }
      }
      if (!empty($newParams))
      {
        foreach ($newParams as $key => $value)
          $url .= $key . '=' . $value . '&';
      }
      $url = rtrim($url, '&');
      return $url;
    }
}