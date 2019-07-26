# Bootstrap a PoP API for WordPress

Quickly launch a WordPress instance with the PoP API (REST and GraphQL-compatible) installed.

## Install

Coming soon...

<!--
### Manual installation

**1. Download WordPress and all PoP components via Composer**

```bash
$ composer create-project leoloso/pop-api-wp yoursitename
```

The script above sets the application options for the `DEV` environment. To set them for `PROD`, prepend the command with `ENV=PROD`:

```bash
$ ENV=PROD composer create-project leoloso/pop-api-wp yoursitename
```

**2. Install the WordPress instance**

- [Install the WordPress database](https://wordpress.org/support/article/how-to-install-wordpress/#step-2-create-the-database-and-a-user)
- [Configure `wp-config.php`](https://wordpress.org/support/article/how-to-install-wordpress/#step-3-set-up-wp-config-php)
- [Run the install script](https://wordpress.org/support/article/how-to-install-wordpress/#step-5-run-the-install-script)

**3. Modify the Site Address (URL)**

Log in to the WordPress admin panel and go to Settings => General (`wp-admin/options-general.php`). There, remove the `/wp` bit from the Site Address (URL) input and save.

**4. Set-up application options**

Upon installation, the Composer script will create file `config/.env` including default values for application options (passed as environment variables). You can further edit this file, or even create more specific ones (following [Symfony's Dotenv component](https://symfony.com/doc/current/components/dotenv.html)'s file hierarchy).
-->
## Installed Components

This bootstrapper will install the WordPress version of the following PoP components:

- [Posts](https://github.com/getpop/posts)
- [Users](https://github.com/getpop/users)
- [Taxonomies](https://github.com/getpop/taxonomies) (tags and categories)
- [Comments](https://github.com/getpop/comments)
- [Pages](https://github.com/getpop/pages)

## Usage

The API is accessed through the following endpoints:

**REST:**

- List of posts: `/posts/?action=api&datastructure=rest`
- Single post: `/{SINGLE-POST-URL}/?action=api&datastructure=rest`
- List of users: `/users/?action=api&datastructure=rest`
- Author: `/{AUTHOR-URL}/?action=api&datastructure=rest`
- List of tags: `/tags/?action=api&datastructure=rest`
- Tag: `/{TAG-URL}/?action=api&datastructure=rest`
- Page: `/{PAGE-URL}/?action=api&datastructure=rest`

**GraphQL:**

Add parameter `fields` to the endpoint URL. Some examples:

- Posts: `/posts/?action=api&datastructure=graphql&fields=id|title|date|url|cat-slugs,author.id|name|url,tags.id|slug|count|url,comments.id|content|date`
- Users: `/users/?action=api&datastructure=graphql&fields=id|name|url,posts.id|title|url|date,posts.tags.id|slug|count|url,posts.comments.id|content|date`
- Tags: `/tags/?action=api&datastructure=graphql&fields=id|slug|count|url,posts.id|title|url|date,posts.author.id|name|url`
- Page: `/{PAGE-URL}/?action=api&datastructure=graphql&fields=id|title|url`

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
