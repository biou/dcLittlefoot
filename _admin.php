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
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('DC_CONTEXT_ADMIN')) {return;}

// dead but useful code, in order to have translations
__('LittleFoot') . __('Empowering footnotes');

$core->addBehavior('adminBlogPreferencesForm', ['littlefootBehaviors', 'adminBlogPreferencesForm']);
$core->addBehavior('adminBeforeBlogSettingsUpdate', ['littlefootBehaviors', 'adminBeforeBlogSettingsUpdate']);

class littlefootBehaviors
{
    public static function adminBlogPreferencesForm($core, $settings)
    {
        # Style options
        $styles = [
            __("Default") => 'default',
            __("Numeric") => 'numeric'
        ];
        $settings->addNameSpace('littlefoot');
        echo
        '<div class="fieldset"><h4 id="littlefoot">LittleFoot</h4>' .
        '<p><label class="classic">' .
        form::checkbox('littlefoot_enabled', '1', $settings->littlefoot->enabled) .
        __('Enable LittleFoot') . '</label></p>' .
        '<h5>' . __('Options') . '</h5>' .
        '<p><label for="littlefoot_style" class="classic">' . __('Style:') . '</label>' .
        form::combo('littlefoot_style', $styles, $settings->littlefoot->style) .
        '</p>' .
        '<p><label for="littlefoot_hover" class="classic">' .
        form::checkbox('littlefoot_hover', '1', $settings->littlefoot->hover) .
        __('Activate on hover') . '</label>' . '</p>' .
        '<p><label for="littlefoot_single" class="classic">' .
        form::checkbox('littlefoot_single', '1', $settings->littlefoot->single) .
        __('Activate only in single entry context') . '</label>' . '</p>' .
            '</div>';
    }

    public static function adminBeforeBlogSettingsUpdate($settings)
    {
        $settings->addNameSpace('littlefoot');
        $settings->littlefoot->put('enabled', !empty($_POST['littlefoot_enabled']), 'boolean');
        $settings->littlefoot->put('style', $_POST['littlefoot_style']);
        $settings->littlefoot->put('hover', !empty($_POST['littlefoot_hover']));
        $settings->littlefoot->put('single', !empty($_POST['littlefoot_single']));
    }
}
