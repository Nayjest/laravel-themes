<?php
return [
    'enabled' => true,                  # Set false to turn package off

    # themed views must be placed in <base_path>/<folder_prefix><theme>/
    
    'theme' => 'default',               # Default theme name, theme name = folder name without prefix

    'folder_prefix' => 'theme_',        # So, for default theme, folder name must be 'theme_default'

    'base_path' => app_path('views'),   # By default, themes are placed in app/views

    'fallback' => [],                   # List of fallback themes can be specified
                                        # If view file is not found in theme folder, it will be searched in fallback themes 
                                        # and only then in default views
];
