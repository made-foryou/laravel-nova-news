<?php

namespace MennoTempelaar\NovaNewsTool\Utils;

use Illuminate\Support\Str;


class Prefixer
{

    /**
     * Prefixes the given table name with the prefix from the configuration.
     *
     * @param  string  $tableName  The table name you want to use.
     *
     * @return string Table name prefixed with prefix from the configuration
     */
    public static function withPrefix ( string $tableName ): string
    {

        $prefix = config('config.table_prefix', 'mt_');

        if (Str::endsWith($prefix, '_')) {

            return $prefix . $tableName;

        }

        return `${$prefix}_${$tableName}`;

    }

}
