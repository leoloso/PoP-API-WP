# Bootstrap WordPress with PoP

Quickly launch a WordPress instance with PoP installed, and containing a bunch of the most popular PoP components.

## Install

**1. Download WordPress and all PoP components via Composer**

```bash
$ composer create-project leoloso/pop-bootstrap-wp yoursitename
```

**2. Install the WordPress instance**

- [Install the WordPress database](https://wordpress.org/support/article/how-to-install-wordpress/#step-2-create-the-database-and-a-user)
- [Configure `wp-config.php`](https://wordpress.org/support/article/how-to-install-wordpress/#step-3-set-up-wp-config-php)
- [Run the install script](https://wordpress.org/support/article/how-to-install-wordpress/#step-5-run-the-install-script)

**3. Modify the Site Address (URL)**

Log in to the WordPress admin panel and go to Settings => General (`wp-admin/options-general.php`). There, remove the `/wp` bit from the Site Address (URL) input and save.

## Installed PoP Components

This bootstrapper installs the following PoP components and their dependencies:

- [Hooks for WordPress](https://github.com/getpop/hooks-wp)
- [Translation for WordPress](https://github.com/getpop/translation-wp)
- [Engine through Symfony](https://github.com/getpop/engine-symfony)
- [Engine for WordPress](https://github.com/getpop/engine-wp)

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
