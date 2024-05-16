<?php
function basePath($path) {
    return __DIR__ . '/' . $path;
}

function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/{$name}.php");
if (file_exists($partialPath)) {
    require $partialPath;
} else {
    echo "{$name}部分视图不存在!";
}
}

function loadView($name,$data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)){
//        inspect($data);
        extract($data);
//        inspect($listings);
//        echo "数据提取后的变量：<br>";
//        foreach ($data as $key => $value) {
//            echo "$key: $value<br>";
//        }
        require $viewPath;
//        echo "<br>视图加载后的变量：<br>";

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
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}
function redirect($url)
{
    header("Location: $url");
    exit;
}