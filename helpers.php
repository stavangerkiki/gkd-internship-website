<?php
function basePath($path) {
    return __DIR__ . '/' . $path;
}

function loadPartial($name)
{
    $partialPath = basePath("views/partials/{$name}.php");
if (file_exists($partialPath)) {
    require $partialPath;
} else {
    echo "{$name}部分视图不存在!";
}
}

function loadView($name)
{
    $viewPath = basePath("views/{$name}.view.php");

    if (file_exists($viewPath)){
    require $viewPath;
} else {
        echo "{$name}视图不存在!";
}
    }

function inspect($value)
{
    echo '<pre>';var_dump($value);echo '<pre>';
}

function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '<pre>';
}