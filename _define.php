<?php
/**
 * @brief littlefoot, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0
 */

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "LittleFoot",                      // Name
    "Empowering footnotes",         // Description
    "Franck Paul and contributors", // Author
    '0.1',                          // Version
    [
        'requires'    => [['core', '2.16']], // Dependencies
        'permissions' => 'admin',            // Permissions
        'type'        => 'plugin',           // Type
        'details'     => 'https://github.com/biou/dcLittlefoot',      // Details URL
        'support'     => 'https://github.com/biou/dcLittlefoot', // Support URL
        'settings'    => [
            'blog' => '#params.littlefoot'
        ]
    ]
);
