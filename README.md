# Bootstrap a PoP API for WordPress

Quickly launch a WordPress instance with the PoP API, REST and GraphQL installed.

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

<!--
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
        "getpop/postmeta-wp": "dev-master",
        "getpop/usermeta-wp": "dev-master",
        "getpop/pages-wp": "dev-master",
        "getpop/postmedia-wp": "dev-master",
        "getpop/commentmeta-wp": "dev-master",
        "getpop/taxonomyquery-wp": "dev-master",
        "getpop/graphql": "dev-master",
        "getpop/api-rest": "dev-master",
        "leoloso/pop-api-endpoints-for-wp": "dev-master"
        ...
    }
    ...
}
```
-->
```bash
{
    "require": {
        "getpop/engine-wp": "dev-master",
        "getpop/postmeta-wp": "dev-master",
        "getpop/usermeta-wp": "dev-master",
        "getpop/pages-wp": "dev-master",
        "getpop/postmedia-wp": "dev-master",
        "getpop/commentmeta-wp": "dev-master",
        "getpop/taxonomyquery-wp": "dev-master",
        "getpop/graphql": "dev-master",
        "getpop/api-rest": "dev-master",
        "leoloso/pop-api-endpoints-for-wp": "dev-master"
    }
}
```

> Note: Only package `"getpop/engine-wp"` is mandatory. The other ones are suggested to load data from posts, users, comments and taxonomies, and to add pretty API endpoints

3. Download and install the packages in your project:

```bash
$ composer update
```

> Note: you will most likely need to wait for a few minutes ☕️😁


4. ✅ Check that the PoP API works by loading in your site: `/api/?query=fullSchema`

**Optionals:**

1. To accept external API queries, add the snippet below in file `.htaccess`:

```apache
<IfModule mod_rewrite.c>
# Enable the server to accept external API queries
Header set Access-Control-Allow-Methods "OPTIONS, GET, POST"
Header set Access-Control-Allow-Headers "origin, content-type"
Header set Access-Control-Allow-Origin "*"
</IfModule>
```

2. Enable pretty permalinks for the API through the `.htaccess` file

Instead of adding dependency `"leoloso/pop-api-endpoints-for-wp"`, you can add pretty permalinks for the API endpoints (such as `/api/graphql`) by adding the following code in the `.htaccess` file (before the WordPress rewrite code, which starts with `# BEGIN WordPress`):

```apache
# Pretty permalinks for API
  # a. Resource endpoints
    # 1. GraphQL or REST: /some-url/api/graphql
    # 2. REST: /some-url/api/rest
    # 3. PoP native: /some-url/api
  # b. Homepage single endpoint (root)
    # 1. GraphQL or REST: /api/graphql
    # 2. REST: /api/rest
    # 3. PoP native: /api
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /

# a. Resource endpoints
# 1 and 2. GraphQL or REST: Rewrite from /some-url/api/(graphql|rest)/ to /some-url/?scheme=api&datastructure=(graphql|rest)
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^(.*)/api/(graphql|rest)/?$ /$1/?scheme=api&datastructure=$2 [L,P,QSA]

# 3. PoP native: Rewrite from /some-url/api/ to /some-url/?scheme=api
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^(.*)/api/?$ /$1/?scheme=api [L,P,QSA]

# b. Homepage single endpoint (root)
# 1 and 2. GraphQL or REST: Rewrite from api/(graphql|rest)/ to /?scheme=api&datastructure=(graphql|rest)
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^api/(graphql|rest)/?$ /?scheme=api&datastructure=$1 [L,P,QSA]

# 3. PoP native: Rewrite from api/ to /?scheme=api
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^api/?$ /?scheme=api [L,P,QSA]
</IfModule>
```

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
$ composer create-project leoloso/pop-api-wp
```

> Note: you will most likely need to wait for a few minutes ☕️😁

4. Execute `install` again to copy the WordPress must-use plugins under folder `/mu-plugins` (somehow it doesn't do it with `create-project`). `cd` into the project's folder (by default `"pop-api-wp"`) and execute:

```bash
$ composer install
```

5. ✅ The site is installed under:

- 👉 WordPress site: `{YOUR_SITE_URL_WITH_HTTP}`
- 👉 WordPress admin: `{YOUR_SITE_URL_WITH_HTTP}`/wp/wp-admin/
- 👉 PoP API: `{YOUR_SITE_URL_WITH_HTTP}/api/?query=fullSchema`

**Optionals:**

1. Configure application options through environment variables. 

PoP relies on [Symfony's Dotenv component](https://symfony.com/doc/current/components/dotenv.html) to define environment variables through file `config/.env`. You can create or further edit this file, and create additional localized `.env` files (such as `.env.local`, as detailed in the [component's documentation](https://symfony.com/doc/current/components/dotenv.html)).

<!--
## Installed Components

This bootstrapper will install the following components (for WordPress):

- [Posts](https://github.com/getpop/posts)
- [Users](https://github.com/getpop/users)
- [Taxonomies](https://github.com/getpop/taxonomies) (tags and categories)
- [Comments](https://github.com/getpop/comments)
- [Pages](https://github.com/getpop/pages)
- [Media](https://github.com/getpop/media)

## Usage

Refer to [PoP API](https://github.com/getpop/api)
-->

## Credits

- [Leonardo Losoviz][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/leoloso
