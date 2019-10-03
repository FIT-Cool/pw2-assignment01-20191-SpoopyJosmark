<?php
function fieldNotEmpty($field = array())
{
    foreach($field as $field)
    {
        if(isset($field) && trim($field) == '')
        {
            return false;
        }
    }
    return true;
}