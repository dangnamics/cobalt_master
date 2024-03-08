# Cobalt
This theme is based heavily on the starter theme [Roots](http://roots.io).

## Frontend Overview

### / Bootstrap
We're using Bootstrap 3 as our base framework.

#### Primary files

##### LESS `assets/less`
   `_bootstrap.less` - Loads all Bootstrap files (`../vendor/bootstrap/less`)

   `_bootstrap-em.less` - Converts Bootstrap to REM based typography

   `_variables.less` - Overrides Bootstrap variables

   `main.less` - Loads our core framework files, as well as our layout files (`layouts/*` + `components/*`)

##### JS `assets/js`
Compiled in this order into `scripts.js` (see `cobalt/files.json`):

1. All bootstrap plugins - Vendor plugins
2. All files from `plugins/` - Specific/complex JS functions
3. `_main.js` - General JS functions

---


## Working in Bootstrap

### / Mixins
Bootstrap allows us to keep our HTML markup symantic, while defining basic layouts via mixins rather than classes.

---


## Notes

### / Grunt
We're using **Grunt** for compiling, cache-busting, syntax-checking, live-reloading, and minifying our LESS and JS. See `Gruntfile.js` for settings.

Grunt allows us to work more efficiently in the development phase, and deploy production-ready assets with a single command.

#### Usage
`grunt dev` - Compile LESS to CSS, concatenate and validate JS.

`grunt watch` - Runs `grunt dev` in the background everytime a file is saved.

`grunt build` - Generates minified files for use in production environment.


#### LiveReload
If `WP_ENV` is set to `development` and 'grunt watch' is running in the background, the website will auto-refresh anytime you make a change.
- Current port set to `1337`. Change to a different port in `Gruntfile.js`.
- If a `.less` file is changed, the page will *only* reload the stylesheets.

#### Settings

##### Javascript
- Compiles all `.js` files inside `assets/js/plugins` and any that begin with an `_` inside `assets/js`
- Output file: `lib/js/scripts.js` or `lib/js/scripts.min.js` (depending on env)
- Runs jshint to search for JS errors
- Removes console.log functions
- Modifies wp_enqueue_script call to update the version based on md5 of files (cache-busting)

##### CSS
- Compiles `lib/less/main.less` and creates CSS and CSS Source Map
- Output file: `lib/css/main.css` or `lib/css/main.min.css` (depending on env)
- Add or remove LESS files in `_main.less`
- Modifies wp_enqueue_style call to update the version based on md5 of files (cache-busting)

### / Loading Scripts and Styles
See `lib/scripts.php` for settings. Use `wp-config.php` to set the environment.

If `define('WP_ENV', 'development')` - Wordpress uses scripts.js and main.css.

If `define('WP_ENV', 'production')` - Wordpress uses scripts.min.js and main.min.css


