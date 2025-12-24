<?php

namespace App\Traits;

trait Trans
{
    function getTransNameAttribute()
    {
        return json_decode($this->name, true)[app()->getLocale()] ?? '';
    }

    function getTransNameEnAttribute()
    {
        return json_decode($this->name, true)['en'];
    }

    function getTransNameArAttribute()
    {
        return json_decode($this->name, true)['ar'];
    }

    function getTransDescriptionAttribute()
    {
        return json_decode($this->description, true)[app()->getLocale()] ?? '';
    }

    function getTransDescriptionEnAttribute()
    {
        return json_decode($this->description, true)['en'];
    }

    function getTransDescriptionArAttribute()
    {
        return json_decode($this->description, true)['ar'];
    }
}
