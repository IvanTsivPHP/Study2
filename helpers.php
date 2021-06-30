<?php

function array_get($array, $key, $default = null)
{
    $keyArray = explode('.', $key);
    foreach ($keyArray as $item) {
        if (is_array($array) && in_array($array[$item], $array)) {
            $array = $array[$item];
        } else {
            return $default;
        }
    }

    return $array;
}

function includeView($templateName, $data = null)
{
    $name = null;
    $templateName = explode('\\', $templateName);
    foreach ($templateName as $value) {
        $name .= DIRECTORY_SEPARATOR . $value;
    }
    return require VIEW_DIR . $name . '.php';
}

function accessCheck($level)
{
    if (isset($_SESSION['access'])) {
        $access = $_SESSION['access'];
    } else {
        $access = 0;
    }
    if ($access >= $level) {
        return true;
    }

    return false;
}

function getIfIsset($var)
{
    if (isset($var)) {
        return $var;
    }

    return false;
}

function modIfIsset($var, $mod)
{
    if (isset($mod)) {
        return $mod;
    }

    return $var;
}

function isThisLimitSet($limit, $defaultLimit)
{
    if ((isset($_GET['limit']) && $limit == $_GET['limit']) || $limit == $defaultLimit) {
        return 'selected';
    }

    return '';
}

function getRequestReassemble($index, $data)
{

    if (isset($_SERVER['QUERY_STRING'])) {
        parse_str($_SERVER['QUERY_STRING'], $getArray);
        foreach ($getArray as $key => $value) {
            if (strpos($value, $index) === 0) {
                $getArray[$key] = $index . '=' . $data;
            }
        }
    }
    $getArray[$index] = $data;
    $result = http_build_query($getArray);

    return $result;
}

function getPage()
{
    if (isset($_GET['page'])) {
        return $_GET['page'];
    } else {
        return 1;
    }
}

function getPaginationLimit($default)
{
    if (isset($_GET['limit'])) {
        if ($_GET['limit'] == 'all') {
            return 0;
        }
        return $_GET['limit'];
    } else {
        return $default;
    }
}

function calcSkip($default)
{
    return 0 + getPaginationLimit($default) * (getPage() - 1);
}
