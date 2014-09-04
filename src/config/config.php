<?php
return [
    'enabled' => true,
    'theme' => 'default', # default theme name
    'folder_prefix' => 'theme_', # themed views must be placed in <base_path>/<folder_prefix><theme>/
    'base_path' => app_path('views'),
    'fallback' => [], # list of fallback themes
];
