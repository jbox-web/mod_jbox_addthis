<?php
/**
 * @package		JBox Tools
 * @author 		Lior Chamla (lchamla@jbox-web.com)
 * @abstract	Adds the AddThis SmartLayer to Joomla!
 * @subpackage	mod_jbox_addthis
 * @copyright	Copyright (C) 2014 JBox Web (http://www.jbox-web.com).
 * @license		GNU General Public License version 2 or later
 */


/**
 * Module after install script class
 */
class mod_jbox_addthisInstallerScript {
	/**
	 * This function is called after the module was installed : make a redirection on the modules list page
	 * @param object $parent
	 */
	function install($parent){
        # $parent is the class calling this method
 		$parent->getParent()->setRedirectURL('index.php?option=com_modules');
    } 
}