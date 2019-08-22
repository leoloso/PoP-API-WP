# Bootstrap a PoP API for WordPress

Quickly launch a WordPress instance with the PoP API (REST and GraphQL-compatible) installed.

## Install

PoP requires PHP 7.1 or higher.

### Installing PoP on an existing WordPress site

Via a WordPress plugin:

_Coming soon..._

-----

Via Composer:

1. Make sure your `composer.json` file has the configuration below to accept minimum stability `"dev"` (there are no releases for PoP yet, and the code is installed directly from the `master` branch):

```javascript
{
    ...
    "minimum-stability": "dev",
    "prefer-stable": true,
    ...
}
```

2. Add the following packages to the `require` section of your `composer.json` file:

_Mandatory:_

```bash
{
    ...
    "require": {
        ...
        "getpop/engine-wp": "dev-master",
        ...
    }
    ...
}
```

_Suggested (to load data from posts, users, comments and taxonomies):_

```bash
{
    ...
    "require": {
        ...
        "getpop/posts-wp": "dev-master",
        "getpop/postmeta-wp": "dev-master",
        "getpop/users-wp": "dev-master",
        "getpop/usermeta-wp": "dev-master",
        "getpop/pages-wp": "dev-master",
        "getpop/comments-wp": "dev-master",
        "getpop/commentmeta-wp": "dev-master",
        "getpop/taxonomies-wp": "dev-master",
        "getpop/taxonomymeta-wp": "dev-master",
        "getpop/taxonomyquery-wp": "dev-master",
        "getpop/api-graphql": "dev-master",
        "getpop/api-rest": "dev-master",
        ...
    }
    ...
}
```

3. Download and install the packages in your project:

```bash
$ composer update
```

4. Wait for a few minutes ☕️😁

5. (Suggested) Enable pretty permalinks for the API endpoints (such as `/some-url/api/`): Add the following code in `.htaccess` file (located in your project's root folder) before the WordPress rewrite code (which start with `# BEGIN WordPress`):

```apache
# Pretty permalinks for API endpoints: rewrite from /some-url/api/ to /some-url/?scheme=api
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^(.*)/api/?$ /$1/?scheme=api [L,P,QSA]
</IfModule>
```

6. ✅ Check that the PoP API works by loading in your site: `/posts/api/?datastructure=rest` (assuming that package `"getpop/posts-wp"` and the URL rewrite were added, as suggested)

### Creating a new WordPress site with PoP installed

Via [Composer](https://getcomposer.org) and [WP-CLI](https://wp-cli.org/) (installed globally):

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

a. Set random values through environment variable `SHUFFLE_SALT_KEYS`:

```bash
export SHUFFLE_SALT_KEYS=true
```

b. Set the corresponding values directly:

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

5. ✅ The site is installed under:

- 👉 WordPress site: `{YOUR_SITE_URL_WITH_HTTP}`
- 👉 WordPress admin: `{YOUR_SITE_URL_WITH_HTTP}`/wp/wp-admin/
- 👉 PoP API: `{YOUR_SITE_URL_WITH_HTTP}/posts/api/?datastructure=rest` (REST for posts)

### Configure application options (optional)

PoP can be configured through environment variables. To make it convenient during development, PoP relies on [Symfony's Dotenv component](https://symfony.com/doc/current/components/dotenv.html) to define environment variables through file `config/.env`. You can create or further edit this file, and create additional localized `.env` files (such as `.env.local`, as detailed in the [component's documentation](https://symfony.com/doc/current/components/dotenv.html)).

## Installed Components

This bootstrapper will install the following components (for WordPress):

- [Posts](https://github.com/getpop/posts)
- [Users](https://github.com/getpop/users)
- [Taxonomies](https://github.com/getpop/taxonomies) (tags and categories)
- [Comments](https://github.com/getpop/comments)
- [Pages](https://github.com/getpop/pages)
- [Media](https://github.com/getpop/media)

## Usage

For the **REST-compatible API**, add parameter `datastructure=rest` to the endpoint URL. 

For the **GraphQL-compatible API**, add parameter `datastructure=graphql` to the endpoint URL, and parameter `fields` with the fields to retrieve (using a [custom dot notation](https://github.com/leoloso/PoP#defining-what-data-to-fetch-through-fields)) from the list of fields defined below. In addition, a field may have [arguments](https://github.com/leoloso/PoP#field-arguments) to modify its results.

For the **PoP native API**, add parameter `fields` to the endpoint URL, similar to GraphQL.

----

Currently, the API supports the following entities and fields:

### Posts

**Endpoints**:

_List of posts:_

- **REST:** [/posts/api/?datastructure=rest](https://nextapi.getpop.org/posts/api/?datastructure=rest)
- **GraphQL:** [/posts/api/?datastructure=graphql](https://nextapi.getpop.org/posts/api/?datastructure=graphql&fields=id|title|url)
- **PoP native:** [/posts/api/](https://nextapi.getpop.org/posts/api/?fields=id|title|url)

_Single post:_

- **REST:** [/{SINGLE-POST-URL}/api/?datastructure=rest](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/api/?datastructure=rest) 
- **GraphQL:** [/{SINGLE-POST-URL}/api/?datastructure=graphql](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/api/?datastructure=graphql&fields=id|title|date|content)
- **PoP native:** [/{SINGLE-POST-URL}/api/](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/api/?fields=id|title|date|content)

**GraphQL fields:**

<table>
<thead>
<tr><th>Property (arguments)</th><th>Relational (arguments)</th></tr>
</thead>
<tbody>
<tr valign="top"><td>id<br/>post-type<br/>published<br/>not-published<br/>title<br/>content<br/>url<br/>endpoint<br/>excerpt<br/>status<br/>is-draft<br/>date (format)<br/>datetime (format)<br/>comments-url<br/>comments-count<br/>has-comments<br/>published-with-comments<br/>cats<br/>cat<br/>cat-name<br/>cat-slugs<br/>tag-names<br/>has-thumb<br/>featuredimage<br/>featuredimage-props (size)</td><td>comments<br/>tags (limit, offset, order, searchfor)<br/>author</td></tr>
</tbody>
</table>

**Examples:**

_List of posts + author data:_<br/>[id|title|date|url,author.id|name|url,author.posts.id|title|url](https://nextapi.getpop.org/posts/api/?datastructure=graphql&fields=id|title|date|url,author.id|name|url,author.posts.id|title|url)

_Single post + tags (ordered by slug), comments and comment author info:_<br/>[id|title|cat-slugs,tags(order:slug|asc).id|slug|count|url,comments.id|content|date,comments.author.id|name|url](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/api/?datastructure=graphql&fields=id|title|cat-slugs,tags(order:slug|asc).id|slug|count|url,comments.id|content|date,comments.author.id|name|url)

### Users

**Endpoints:**

_List of users:_

- **REST:** [/users/api/?datastructure=rest](https://nextapi.getpop.org/users/api/?datastructure=rest)
- **GraphQL:** [/users/api/?datastructure=graphql](https://nextapi.getpop.org/users/api/?datastructure=graphql&fields=id|name|url)
- **PoP native:** [/users/api/](https://nextapi.getpop.org/users/api/?fields=id|name|url)

_Author:_

- **REST:** [/{AUTHOR-URL}/api/?datastructure=rest](https://nextapi.getpop.org/author/themedemos/api/?datastructure=rest) 
- **GraphQL:** [/{AUTHOR-URL}/api/?datastructure=graphql](https://nextapi.getpop.org/author/themedemos/api/?datastructure=graphql&fields=id|name|description)
- **PoP native:** [/{AUTHOR-URL}/api/](https://nextapi.getpop.org/author/themedemos/api/?fields=id|name|description)

**GraphQL fields:**

<table>
<thead>
<tr><th>Property (arguments)</th><th>Relational (arguments)</th></tr>
</thead>
<tbody>
<tr valign="top"><td>id<br/>username<br/>user-nicename<br/>nicename<br/>name<br/>display-name<br/>firstname<br/>lastname<br/>email<br/>url<br/>endpoint<br/>description<br/>website-url</td><td>posts (limit, offset, order, searchfor, date-from, date-to)</td></tr>
</tbody>
</table>

**Examples:**

_List of users + up to 2 posts for each, ordered by date:_<br/>[id|name|url,posts(limit:2;order:date|desc).id|title|url|date](https://nextapi.getpop.org/users/api/?datastructure=graphql&fields=id|name|url,posts(limit:2;order:date|desc).id|title|url|date)

_Author + all posts, with their tags and comments, and the comment author info:_<br/>[id|name|url,posts.id|title,posts.tags.id|slug|count|url,posts.comments.id|content|date,posts.comments.author.id|name](https://nextapi.getpop.org/author/themedemos/api/?datastructure=graphql&fields=id|name|url,posts.id|title,posts.tags.id|slug|count|url,posts.comments.id|content|date,posts.comments.author.id|name)

### Comments

**GraphQL fields:**

<table>
<thead>
<tr><th>Property (arguments)</th><th>Relational (arguments)</th></tr>
</thead>
<tbody>
<tr valign="top"><td>id<br/>content<br/>author-name<br/>author-url<br/>author-email<br/>approved<br/>type<br/>date (format)</td><td>author<br/>post<br/>post-id<br/>parent</td></tr>
</tbody>
</table>

**Examples:**

_Single post's comments:_<br/>[comments.id|content|date|type|approved|author-name|author-url|author-email](https://nextapi.getpop.org/2013/01/11/markup-html-tags-and-formatting/api/?datastructure=graphql&fields=comments.id|content|date|type|approved|author-name|author-url|author-email)

### Tags

**Endpoints:**

_List of tags:_

- **REST:** [/tags/api/?datastructure=rest](https://nextapi.getpop.org/tags/api/?datastructure=rest)
- **GraphQL:** [/tags/api/?datastructure=graphql](https://nextapi.getpop.org/tags/api/?datastructure=graphql&fields=id|slug|count|url)
- **PoP native:** [/tags/api/](https://nextapi.getpop.org/tags/api/?fields=id|slug|count|url)

_Tag:_

- **REST:** [/{TAG-URL}/api/?datastructure=rest](https://nextapi.getpop.org/tag/html/api/?datastructure=rest) 
- **GraphQL:** [/{TAG-URL}/api/?datastructure=graphql](https://nextapi.getpop.org/tag/html/api/?datastructure=graphql&fields=id|name|slug|count)
- **PoP native:** [/{TAG-URL}/api/](https://nextapi.getpop.org/tag/html/api/?fields=id|name|slug|count)

**GraphQL fields:**

<table>
<thead>
<tr><th>Property (arguments)</th><th>Relational (arguments)</th></tr>
</thead>
<tbody>
<tr valign="top"><td>id<br/>symbol<br/>symbolnamedescription<br/>namedescription<br/>url<br/>endpoint<br/>symbolname<br/>name<br/>slug<br/>term_group<br/>term_taxonomy_id<br/>taxonomy<br/>description<br/>count</td><td>parent<br/>posts (limit, offset, order, searchfor, date-from, date-to)</td></tr>
</tbody>
</table>

**Examples:**

_List of tags + all their posts filtered by date and ordered by title, their comments, and the comment authors:_<br/>[id|slug|count|url,posts(date-from:2009-09-15;date-to:2010-07-10;order:title|asc).id|title|url|date](https://nextapi.getpop.org/tags/api/?datastructure=graphql&fields=id|slug|count|url,posts(date-from:2009-09-15;date-to:2010-07-10;order:title|asc).id|title|url|date)

_Tag + all their posts, their comments and the comment authors:_<br/>[id|slug|count|url,posts.id|title,posts.comments.content|date,posts.comments.author.id|name|url](https://nextapi.getpop.org/tag/html/api/?datastructure=graphql&fields=id|slug|count|url,posts.id|title,posts.comments.content|date,posts.comments.author.id|name|url)

### Pages

**Endpoints:**

_Page:_

- **REST:** [/{PAGE-URL}/api/?datastructure=rest](https://nextapi.getpop.org/about/api/?datastructure=rest)
- **GraphQL:** [/{PAGE-URL}/api/?datastructure=graphql](https://nextapi.getpop.org/about/api/?datastructure=graphql&fields=id|title|content)
- **PoP native:** [/{PAGE-URL}/api/](https://nextapi.getpop.org/about/api/?fields=id|title|content)

**GraphQL fields:**

<table>
<thead>
<tr><th>Property (arguments)</th><th>Relational (arguments)</th></tr>
</thead>
<tbody>
<tr valign="top"><td>id<br/>title<br/>content<br/>url</td><td>&nbsp;</td></tr>
</tbody>
</table>

**Examples:**

_Page:_<br/>[id|title|content|url](https://nextapi.getpop.org/about/api/?datastructure=graphql&fields=id|title|content|url)

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
