<?php

function get_count_file(string $file) : int
{
    $count = 0;
    if(file_exists($file))
    {
        $count = (int)file_get_contents($file);
    }
    return $count;
}

function increment_count() : int
{
    $file_name = 'data/count';
    $count = get_count_file($file_name);
    if (file_exists($file_name))
        file_put_contents($file_name, $count + 1);
    return $count + 1;
}