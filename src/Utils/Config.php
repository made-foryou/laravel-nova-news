<?php

namespace Bondgenoot\NovaNewsTool\Utils;

class Config
{
    public static function authorClassname(): string
    {
        return Prefix::config('author.model');
    }
}
