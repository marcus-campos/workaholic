<?php
/**
 * User: marcus-campos
 * Date: 18/03/18
 * Time: 20:05
 */

function inputValue($input, $definedVars = null, $data = null)
{
    if($old = old($input)) {
        return $old;
    }

    if(!empty($definedVars)) {
        $value = null;

        if(isset($definedVars[key($data)]) && !empty($definedVars[key($data)])) {
            $value = $definedVars[key($data)];

            $position = explode('.', $data[key($data)]);

            foreach ($position as $item) {
                $value = $value[$item];
            }
        }

        return $value;
    }

}

/*
 * Make a query string and add to original route
 */
function queryStringMaker($url, $filters = null, $perPage = null, $orderBy = null)
{
    //$url = str_replace('http://', '', str_replace('https://', '', $url));

    if (!empty($perPage)) {
        $has = strpos($url, '?');

        if ($has > 0) {
            $url .= '&perPage='.$perPage;
        } else {
            $url .= '?perPage='.$perPage;
        }
    }

    if (!empty($filters)) {
        $has = strpos($url, '?');

        if ($has > 0) {
            $url .= '&filters=[' . $filters . ']';
        } else {
            $url .= '?filters=[' . $filters . ']';
        }
    }

    if (!empty($orderBy)) {
        $has = strpos($url, '?');

        if ($has > 0) {
            $url .= '&orderBy=[' . $orderBy . ']';
        } else {
            $url .= '?orderBy=[' . $orderBy . ']';
        }
    }

    return $url;
}