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

This bootstrapper will install the following components (for WordPress):

- [Posts](https://github.com/getpop/posts)
- [Users](https://github.com/getpop/users)
- [Taxonomies](https://github.com/getpop/taxonomies) (tags and categories)
- [Comments](https://github.com/getpop/comments)
- [Pages](https://github.com/getpop/pages)

## Usage

The API is accessed through the following endpoints (click on them to see an example):

**REST-compatible:**

Add parameters `action=api&datastructure=rest` to the endpoint URL:

- List of posts:<br/>[/posts/?action=api&datastructure=rest](https://nextapi.getpop.org/posts/?action=api&datastructure=rest)
- Single post:<br/>[/{SINGLE-POST-URL}/?action=api&datastructure=rest](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/?action=api&datastructure=rest)
- List of users:<br/>[/users/?action=api&datastructure=rest](https://nextapi.getpop.org/users/?action=api&datastructure=rest)
- Author:<br/>[/{AUTHOR-URL}/?action=api&datastructure=rest](https://nextapi.getpop.org/author/themedemos/?action=api&datastructure=rest)
- List of tags:<br/>[/tags/?action=api&datastructure=rest](https://nextapi.getpop.org/tags/?action=api&datastructure=rest)
- Tag:<br/>[/{TAG-URL}/?action=api&datastructure=rest](https://nextapi.getpop.org/tag/html?action=api&datastructure=rest)
- Page:<br/>[/{PAGE-URL}/?action=api&datastructure=rest](https://nextapi.getpop.org/about/?action=api&datastructure=rest)

**GraphQL-compatible:**

Add parameters `action=api&datastructure=graphql` to the endpoint URL, and parameter `fields` with the data fields to retrieve (using a [custom dot notation](https://github.com/leoloso/PoP#how-does-it-work)). Examples:

- List of posts (+ author data):<br/>[/posts/?action=api&datastructure=graphql&fields=id|title|date|url,author.id|name|url,author.posts.id|title|url](https://nextapi.getpop.org/posts/?action=api&datastructure=graphql&fields=id|title|date|url,author.id|name|url,author.posts.id|title|url)
- Single post (+ tags and comments):<br/>[/{SINGLE-POST-URL}/?action=api&datastructure=graphql&fields=id|title|cat-slugs,tags.id|slug|count|url,comments.id|content|date,comments.author.id|name|url](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/?action=api&datastructure=graphql&fields=id|title|cat-slugs,tags.id|slug|count|url,comments.id|content|date,comments.author.id|name|url)
- List of users (+ up to 2 posts for each):<br/>[/users/?action=api&datastructure=graphql&fields=id|name|url,posts(limit:2).id|title|url|date](https://nextapi.getpop.org/users/?action=api&datastructure=graphql&fields=id|name|url,posts(limit:2).id|title|url|date)
- Author (+ all posts, with their tags and comments):<br/>[/{AUTHOR-URL}/?action=api&datastructure=graphql&fields=id|name|url,posts.id|title,posts.tags.id|slug|count|url,posts.comments.id|content|date](https://nextapi.getpop.org/author/themedemos/?action=api&datastructure=graphql&fields=id|name|url,posts.id|title,posts.tags.id|slug|count|url,posts.comments.id|content|date)
- List of tags (+ all their posts ordered by title, their comments, and the comment authors):<br/>[/tags/?action=api&datastructure=graphql&fields=id|slug|count|url,posts(orderby:title;order:asc).id|title|url|date](https://nextapi.getpop.org/tags/?action=api&datastructure=graphql&fields=id|slug|count|url,posts(orderby:title;order:asc).id|title|url|date)
- Tag (+ all their posts, their comments and the comment authors):<br/>[/tags/?action=api&datastructure=graphql&fields=id|slug|count|url,posts.id|title,posts.comments.content|date,posts.comments.author.id|name|url](https://nextapi.getpop.org/tag/html/?action=api&datastructure=graphql&fields=id|slug|count|url,posts.id|title,posts.comments.content|date,posts.comments.author.id|name|url)
- Page:<br/>[/{PAGE-URL}/?action=api&datastructure=graphql&fields=id|title|url](https://nextapi.getpop.org/about/?action=api&datastructure=graphql&fields=id|title|url)

**PoP native:**

Add parameters `action=api` to the endpoint URL, and parameter `fields` similar to the examples above for GraphQL.

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
