# Bootstrap WordPress

Bootstrap a PoP project for WordPress

## Install

Via Composer

```bash
$ composer create-project leoloso/pop-bootstrap-wp wordpress dev-master
```

Then add your DB information in `wp-config.php`.

Alternatively, you can already provide the DB information like this:

```bash
DB_NAME=your_db_name \
DB_USER=your_db_user \
DB_PASSWORD=your_db_pwd \
composer create-project leoloso/pop-bootstrap-wp wordpress dev-master
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
