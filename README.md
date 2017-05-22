# Bootstrap 3/Gulp starter.

## Intro

### Setup

Make sure you have node installed. From Terminal, run

```
npm install
bower install
```

to install build and front-end dependencies.

### Gulp

Gulp is a task runner to help automate tasks. From Terminal, run

```
gulp build
```

to build your `dist` folder from scratch. Run

```
gulp watch
```

to launch BrowserSync and enable live development.

You can also run `gulp acf` to create an ACF export file for others to use. This should be committed with each change.

## Best practices

* Hard-code as little text into templates as possible, and when you do so, use `_e()` or `__()` instead of including text directly. This will keep your theme translation-ready should such a need arise.
* Make sure that your ACF export file is up-to-date with what's in your local copy of the site as well as what's in the master version of the repo.
* PHP files in `/lib/dev` should **not** be deployed to production. They're resources for local development and might make publicly-available data that you'd prefer not to be.
* When writing image URLs, make sure that paths point to `/dist/img`, as this will contain optimized images. For example, `<img src="<?= get_stylesheet_directory() . '/dist/img/logo.png'; ?>" alt="...">`.
* Make sure that the url in gulp-config.json has been updated to your local development url.
