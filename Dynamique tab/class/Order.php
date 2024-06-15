<?php
namespace App;

class Order {
    public static function reverse_order($order) {
        return $order === 'asc' ? 'desc' : 'asc';
    }
}