<?php

/* Main Config */
$admin_id = '76561198152390718';
$debug = 0;
$error_log_file = 'logs/error.log';
$gamemode_specific = 1;
$login = 1;
$theme = 'simple';
$themes_active = [
    [
        id   => 'simple',
        name => 'Simple',
        desc => 'Basic Layout',
    ],
    [
        id   => 'oxygen',
        name => 'Oxygen',
        desc => 'Clean, but effective design',
    ],
    [
        id   => 'material',
        name => 'Materialize',
        desc => 'Material style themed containing server info and rules',
    ],
];

/* SteamAPI Config */
$steamauth['apikey'] = '';
$steamauth['domainname'] = '';

/* MySQL Config */
$mysql['host'] = '';
$mysql['port'] = 3306;
$mysql['user'] = '';
$mysql['pass'] = '';
$mysql['db'] = '';
$mysql['table'] = 'kload_users';

/* Theme Config */
$color['background'] = '#121212';
$color['font'] = '#fff';
$color['primary'] = '#03a9f4';
$color['secondary'] = '#4caf50';
$overlay = 1;

/* Background Config */
$background['type'] = 3;
$background['image'] = 'assets/images/backgrounds/particles.png';
$background['video'] = '';
$background['yt_playlist'] = '';
$background['random'] = 0;
$background['duration'] = 10;
$background['slideshow']['global'] = [
    'assets/images/backgrounds/particles.png',
];

/* Music Config */
$volume = 15;
$youtube['playlist'] = '';

/* Messages/Announcements */
$message['random'] = 1;
$message['duration'] = 4;
$message['list']['global'] = [
    'Welcome to our server',
];

/* Rules (Include numbering if you want it) */
$rules['global'] = [
    'No Hacking',
];

/* Staff */
$staff = [
    [
        'steamid' => '76561198152390718',
        'rank'    => 'Owner',
    ],
];
