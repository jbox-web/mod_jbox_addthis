<?php
/**
 * @package		JBox Tools
 * @author 		Lior Chamla (lchamla@jbox-web.com)
 * @abstract	Adds the AddThis SmartLayer to Joomla!
 * @subpackage	mod_jbox_addthis
 * @copyright	Copyright (C) 20011 - 2014 JBox Web (http://www.jbox-web.com).
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

class mod_jbox_addthisInstallerScript {
	function install($parent)
    {
        # $parent is the class calling this method
 		$parent->getParent()->setRedirectURL('index.php?option=com_modules');
    } 
}
