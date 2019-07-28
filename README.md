# Bootstrap a PoP API for WordPress

Quickly launch a WordPress instance with the PoP API (REST and GraphQL-compatible) installed.

## Install

Via [Composer](https://getcomposer.org) and [WP-CLI](https://wp-cli.org/):

1. Create the [WordPress database and user](https://wordpress.org/support/article/how-to-install-wordpress/#step-2-create-the-database-and-a-user)
2. Set environment variables: Copy the code below to an editor, replace all values (such as `{YOUR_SITE_FOLDER_NAME}`) with your own values, and then paste it on the terminal to execute:

```bash
export FOLDER_NAME={YOUR_SITE_FOLDER_NAME} #eg: root
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

3. In the terminal, `cd` to the folder where to install the site, and execute script:

```bash
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install.sh | bash
```

4. Wait for a few minutes ☕️😁
5. Test if successful:
    - WordPress site under {YOUR_SITE_URL_WITH_HTTP}
    - WordPress admin under {YOUR_SITE_URL_WITH_HTTP}/wp/wp-admin/
    - PoP API under {YOUR_SITE_URL_WITH_HTTP}/posts/?action=api&datastructure=rest

<!--
```bash

# Install PoP and WordPress through Composer:
composer create-project leoloso/pop-api-wp $FOLDER_NAME dev-master

# Install the must-use plugins:
cd $FOLDER_NAME
composer install

# Configure wp-config.php through WP-CLI: (reference: https://developer.wordpress.org/cli/commands/config/set/)
wp config set DB_NAME $DB_NAME
wp config set DB_USER $DB_USER
wp config set DB_PASSWORD $DB_PASSWORD
wp config set DB_HOST $DB_HOST

# Generate random SALT keys through WP-CLI: (reference: https://developer.wordpress.org/cli/commands/config/shuffle-salts/)
wp config shuffle-salts

# Install WordPress: (reference: https://developer.wordpress.org/cli/commands/core/install/)
wp core install --url=$SITE_URL_WITHOUT_HTTP --title="$SITE_NAME" --admin_user=$ADMIN_USER --admin_password=$ADMIN_PASSWORD --admin_email=$ADMIN_EMAIL

# Update the site URL, adding "/wp"
wp option update siteurl $SITE_URL_WITH_HTTP/wp
```
-->
### Configure application options (optional)

Upon installation, the Composer script will create file `config/.env` including default values for application options (passed as environment variables). You can further edit this file, or even create more specific ones (following [Symfony's Dotenv component](https://symfony.com/doc/current/components/dotenv.html)'s file hierarchy).

<!--
2. Execute the bash script below, replacing all variables values (such as `{YOUR_SITE_FOLDER_NAME}`) with your own values:

```bash
FOLDER_NAME={YOUR_SITE_FOLDER_NAME} \
DB_NAME={YOUR_SITE_DB_NAME} \
DB_USER={YOUR_SITE_DB_USER} \
DB_PASSWORD={YOUR_SITE_DB_PASSWORD} \
DB_HOST={YOUR_SITE_DB_HOST} \
SITE_URL_WITHOUT_HTTP={YOUR_SITE_URL_WITHOUT_HTTP} \
SITE_URL_WITH_HTTP={YOUR_SITE_URL_WITH_HTTP} \
SITE_NAME="{YOUR_SITE_NAME}" \
ADMIN_USER={ADMIN_USER} \
ADMIN_PASSWORD={ADMIN_PASSWORD} \
ADMIN_EMAIL={ADMIN_EMAIL} \
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install.sh | bash
```
-->

<!--
**1. Download PoP and WordPress via Composer**

```bash
$ composer create-project leoloso/pop-api-wp {YOUR_SITE_NAME} dev-master
```

_For more control:_ The script above can be prepended with environment variables to configure WordPress and set the default application options.

WordPress configuration (added to `wp-config.php`):

- `DB_NAME`: WordPress DB name
- `DB_USER`: WordPress DB user
- `DB_PASSWORD`: WordPress DB password
- `DB_HOST`: WordPress DB host
- `GENERATE_SALTS`: Generate random salts (`true` or `false`, default `false`)

Application options:

- `ENV`: environment (`"DEV"` or `"PROD"`, default `"DEV"`)

Example: 

```bash
$ DB_NAME={YOUR_DB_NAME} \
DB_USER={YOUR_DB_USER} \
DB_PASSWORD={YOUR_DB_PASSWORD} \
DB_HOST={YOUR_DB_HOST} \
GENERATE_SALTS=true \
composer create-project leoloso/pop-api-wp {YOUR_SITE_NAME} dev-master
```

**2. Install WordPress**

- [Install the WordPress database](https://wordpress.org/support/article/how-to-install-wordpress/#step-2-create-the-database-and-a-user)
- [Configure `wp-config.php`](https://wordpress.org/support/article/how-to-install-wordpress/#step-3-set-up-wp-config-php)
- [Run the install script](https://wordpress.org/support/article/how-to-install-wordpress/#step-5-run-the-install-script)

**3. Modify the Site Address (URL)**

Log in to the WordPress admin panel and go to Settings => General (`wp-admin/options-general.php`). There, remove the `/wp` bit from the Site Address (URL) input and save.

**4. Set-up application options (optional)**

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
