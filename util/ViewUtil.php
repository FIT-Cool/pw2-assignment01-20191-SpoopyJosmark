<?php


class ViewUtil
{
    public static function fieldNotEmpty($field = array())
    {
        foreach ($field as $field) {
            if (isset($field) && trim($field) == '') {
                return false;
            }
        }
        return true;
    }
}