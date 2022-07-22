# nova-news-resource-tool
This package contains management features for managing a news section within a web application.

## Installation

At first, we need to install the package onto our Laravel application:

```shell
composer require mennotempelaar/nova-news-resource-tool
```

To publish the configuration files from this package:
```shell
php artisan vendor:publish --provider="Bondgenoot\NovaNewsTool\Providers\NewsServiceProvider"
```

Now we need to publish the files from the [advoor/nova-editor-js](https://github.com/advoor/nova-editor-js) package.

```shell
php artisan vendor:publish --provider="Advoor\NovaEditorJs\FieldServiceProvider"
```

The only thing left is to generate the database tables according to the migration files from the package.

```shell
php artisan migrate
```

Now, you can use the package to the fullest.

### Testing

The package uses `PestPHP` for testing.

```shell
./vendor/bin/pest
```


