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