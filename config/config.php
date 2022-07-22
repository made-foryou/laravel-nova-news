<?php

return [

    /**
     * Database Table prefix
     * ------------------------------------------------------------------------
     *
     * The following configuration option contains the prefix that will be
     * used when generating the database tables. The default prefix is
     * mt_ and it can be changed in whatever you prefer.
     */
    'table_prefix' => 'mt_',

    /**
     * Author
     * ------------------------------------------------------------------------
     *
     * Configuration setting for using a custom author implementation.
     */
    'author' => [
        /**
         * The model name which will be used as relation for the author
         * of posts
         */
        'model' => config('auth.providers.users.model'),
    ],

];
