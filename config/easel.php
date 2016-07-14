<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Blog Meta Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the blog meta tags for your application.
    | These will be used for web scraping and open graph tags
    | on sites such as Facebook and Twitter.
    |
    */
    'name'            => 'Easel',
    'title'           => 'Easel for your Canvas',
    'subtitle'        => 'Minimal Blogging Package',
    'description'     => 'Blog package for laravel apps',
    'author'          => 'Talv Bansal',

    /*
    |--------------------------------------------------------------------------
    | Blog Post Configuration
    |--------------------------------------------------------------------------
    |
    | Pretty self-explanatory here. Indicate how many posts you would like
    | to appear on each page. If you are using Disqus, provide the
    | identifier here or in your .env
    |
    */
    'posts_per_page'  => 6,
    'disqus_name' => env('DISQUS_NAME', 'YOUR_UNIQUE_SHORTNAME'),

    /*
    |--------------------------------------------------------------------------
    | Uploads Configuration
    |--------------------------------------------------------------------------
    |
    | Specify what type of storage you would like for your application. Just
    | as a reminder, your uploads directory MUST be writable by the
    | web server for the uploading to function properly.
    |
    | Supported: "local"
    |
    */
    'uploads'         => [
        'storage'       => 'local',
        'webpath'       => '/uploads/',
    ],

];
