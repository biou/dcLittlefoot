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

if (!defined('DC_RC_PATH')) {return;}

$core->addBehavior('publicHeadContent', ['littlefootPublic', 'publicHeadContent']);

class littlefootPublic
{
    public static function publicHeadContent($core)
    {
        $core->blog->settings->addNameSpace('littlefoot');
        if (!$core->blog->settings->littlefoot->enabled) {
            return;
        }

        if ($core->blog->settings->littlefoot->single) {
            // Single mode only, check if post/page context
            $urlTypes = ['post'];
            if ($core->plugins->moduleExists('pages')) {
                $urlTypes[] = 'page';
            }
            if (!in_array($core->url->type, $urlTypes)) {
                return;
            }
        }

        $style = $core->blog->settings->littlefoot->style;
        if (!in_array($style, ['default', 'numeric'])) {
            $style = 'default';
        }

        echo
        dcUtils::jsJson('littlefoot', [
            'style' => $style,
            'hover' => ($core->blog->settings->littlefoot->hover ? true : false),
            'i18n-footnote' => __('Footnote'),
            'i18n-see-footnote' => __('See Footnote')
        ]) .
        dcUtils::cssLoad($core->blog->getPF('dcLittlefoot/css/littlefoot.css')) .
        dcUtils::cssLoad($core->blog->getPF('dcLittlefoot/css/custom.css')) .
        dcUtils::jsLoad($core->blog->getPF('dcLittlefoot/js/littlefoot.js')) .
        dcUtils::jsLoad($core->blog->getPF('dcLittlefoot/js/apply.js'));
    }
}
