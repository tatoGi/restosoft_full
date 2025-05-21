<?php

return [
    'image_path' => 'uploads/img/',
    'thumb_path' => 'thumb/',
    'file_path' => 'uploads/files/',
    'icon_path' => 'uploads/icons/',
    'profile_path' => 'uploads/profile/',
    'json_path' => 'uploads/json/',
    'thumbnail' => [
        'width' => 320,
        'height' => 200,
    ],

];
define('CLIENT_ID', 'YOUR_CLIENT_ID');
define('CLIENT_SECRET', 'YOUR_CLIENT_SECRET');
define('REDIRECT_URL', 'http://localhost/linkedin/callback.php');
define('SCOPES', 'r_emailaddress,r_liteprofile,w_member_social');
