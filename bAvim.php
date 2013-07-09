<?php
/*
 * Avim - Vietnamese Input Method for MyBB
 * Author: heroandtn3 (heroandtn3 [at] gmail.com)
 * Website: www.sangnd.com
 * CopyRight: (c) heroandtn3 2013
*/
 /****************************************************************************
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
****************************************************************************/
if (!defined("IN_MYBB")) {
    die("You can not directly access this file");
}

// add hook
$plugins->add_hook('global_end', 'bAvim_hook');

if (!defined("PLUGINLIBRARY")) {
    define("PLUGINLIBRARY", MYBB_ROOT."inc/plugins/pluginlibrary.php");
}

function bAvim_info() {
	return array(
		'name'          => 'BB Avim - Vietnamese Input Method',
        'description'   => 'Avim - Vietnamese Input Method for MyBB',
        'website'       => 'http://sangnd.com',
        'author'        => 'heroandtn3',
        'authorsite'    => 'http://sangnd.com',
        'version'       => '1.0',
        'compatibility' => '16*',
        'guid'          => ''
        );
}

function bAvim_activate() {
    if (!file_exists(PLUGINLIBRARY)) {
        flash_message("The selected plugin could not be installed because <a href=\"http://mods.mybb.com/view/pluginlibrary\">PluginLibrary</a> is missing.", "error");
        admin_redirect("index.php?module=config-plugins");
    }

    global $PL;
    $PL or require_once PLUGINLIBRARY;

    if ($PL->version < 11) {
        flash_message("The selected plugin could not be installed because <a href=\"http://mods.mybb.com/view/pluginlibrary\">PluginLibrary</a> is too old.", "error");
        admin_redirect("index.php?module=config-plugins");
    }

    $PL->settings(
    	'bAvim',
    	'BB Avim - Vietnamese Input Method',
    	'BB Avim - Vietnamese Input Method Plugin Settings',
    	array(
    		'onoff'	=> array(
                'title'         => 'On/off',
                'description'   => 'Turn plugin on/off',
                'optionscode'   => 'onoff',
                'value'         => '1'
    			)
    	)
    );
}

function bAvim_deactivate() {
	global $PL;
    $PL or require_once PLUGINLIBRARY;
	$PL->settings_delete("bAvim");
}

function bAvim_hook() {
	global $footer, $mybb;
	if (intval($mybb->settings['bAvim_onoff']) == 1) {
        $footer = $footer.'<!--AVIM Engine-->
		<script type="text/javascript" src="sangnd/avim/avim.js"></script>';
    }
}

?>