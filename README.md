# Bootstrap a PoP API for WordPress

Quickly launch a WordPress instance with the PoP API (REST and GraphQL-compatible) installed.

## Install

Via [Composer](https://getcomposer.org) and [WP-CLI](https://wp-cli.org/) (both are assumed to be installed globally):

1. Create the [WordPress database and user](https://wordpress.org/support/article/how-to-install-wordpress/#step-2-create-the-database-and-a-user)
2. Configure WordPress through environment variables: 

> Copy the code below to an editor, replace all values (such as `{YOUR_SITE_DB_NAME}`) with your own values, and then either paste it on the terminal to execute, or save it in file "~/.bash_profile" and then execute `source ~/.bash_profile`.

```bash
export DB_NAME={YOUR_SITE_DB_NAME} #eg: database
export DB_USER={YOUR_SITE_DB_USER} #eg: admin
export DB_PASSWORD={YOUR_SITE_DB_PASSWORD} #eg: sADF!kl9diq@#Sjfk
export DB_HOST={YOUR_SITE_DB_HOST} #eg: 127.0.0.1
export SITE_URL_WITHOUT_HTTP={YOUR_SITE_URL_WITHOUT_HTTP} #eg: localhost
export SITE_URL_WITH_HTTP={YOUR_SITE_URL_WITH_HTTP} #eg: http://localhost
export SITE_NAME="{YOUR_SITE_NAME}" #eg: "My awesome website"
export ADMIN_USER={ADMIN_USER} #eg: admin
export ADMIN_PASSWORD={ADMIN_PASSWORD} #eg: JKo$@sfjASD00w
export ADMIN_EMAIL={ADMIN_EMAIL} #eg: pedro@example.com
```

To set the SALT keys there are two alternatives:

I. Set random values through environment variable `SHUFFLE_SALT_KEYS`:

```bash
export SHUFFLE_SALT_KEYS=true
```

II. Set the corresponding values directly:

```bash
# Obtain random values from https://api.wordpress.org/secret-key/1.1/salt
export AUTH_KEY={YOUR_AUTH_KEY}
export SECURE_AUTH_KEY={YOUR_SECURE_AUTH_KEY}
export LOGGED_IN_KEY={YOUR_LOGGED_IN_KEY}
export NONCE_KEY={YOUR_NONCE_KEY}
export AUTH_SALT={YOUR_AUTH_SALT}
export SECURE_AUTH_SALT={YOUR_SECURE_AUTH_SALT}
export LOGGED_IN_SALT={YOUR_LOGGED_IN_SALT}
export NONCE_SALT={YOUR_NONCE_SALT}
```

3. Bootstrap a new project from this repo:

```bash
composer create-project leoloso/pop-api-wp
```

4. Wait for a few minutes ☕️😁
5. ✅ Check that WordPress was successfully installed:

    - 👉WordPress site: {YOUR_SITE_URL_WITH_HTTP}
    - 👉WordPress admin: {YOUR_SITE_URL_WITH_HTTP}/wp/wp-admin/
    - 👉PoP API: {YOUR_SITE_URL_WITH_HTTP}/posts/?action=api&datastructure=rest (REST for posts)

### Configure application options (optional)

Upon installation, the Composer script will create file `config/.env` including default values for application options (passed as environment variables). You can further edit this file, or even create more specific ones (following [Symfony's Dotenv component](https://symfony.com/doc/current/components/dotenv.html)'s file hierarchy).

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
- Tag:<br/>[/{TAG-URL}/?action=api&datastructure=rest](https://nextapi.getpop.org/tag/html/?action=api&datastructure=rest)
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
