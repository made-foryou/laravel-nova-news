<?php

namespace MennoTempelaar\NovaNewsTool\Utils;

use Illuminate\Support\Str;

use function __;


class Prefix
{

    const TRANSLATION_PREFIX = 'nova-news-tool::';

    /**
     * Prefixes the given table name with the prefix from the configuration.
     *
     * @param  string  $tableName  The table name you want to use.
     *
     * @return string Table name prefixed with prefix from the configuration
     */
    public static function withPrefix ( string $tableName ): string
    {

        $prefix = config( 'config.table_prefix', 'mt_' );

        if ( Str::endsWith( $prefix, '_' ) ) {

            return $prefix . $tableName;

        }

        return `${$prefix}_${$tableName}`;

    }

    /**
     * Prefixes the key with the package translation name and returns the
     * translated value of that prefixed key.
     *
     * @param  string                 $key      The key to search the
     *                                          translation for within this
     *                                          package translations.
     * @param  array<string, string>  $replace  The replaces :name indexes with
     *                                          the given value within the
     *                                          translation.
     *
     * @return string  The translated value from that key.
     */
    public static function translate (
        string $key,
        array  $replace = [],
    ): string {

        return __( self::TRANSLATION_PREFIX . $key, $replace );

    }

}
