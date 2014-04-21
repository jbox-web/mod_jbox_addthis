<?php
/**
 * @package     JBox Tools
 * @author      Lior Chamla (lchamla@jbox-web.com)
 * @abstract    Adds the AddThis SmartLayer to Joomla!
 * @subpackage  mod_jbox_addthis
 * @copyright   Copyright (C) 2014 JBox Web (http://www.jbox-web.com).
 * @license     GNU General Public License version 2 or later
 */

// no direct access
defined('_JEXEC') or die;

// Let's see if you have an AddThis ID :
$addthis = $params->get('analyticsId', null);

// add AddThis SmartLayer script
$document = JFactory::getDocument();
$document->addScript("//s7.addthis.com/js/300/addthis_widget.js" . ($addthis ? "#pubid=" . $addthis : ""));

// add custom css code
$document->addStyleDeclaration($params->get('styles', null));

// begin script generation
$script = "";

// if Sharing is active :
if($activeShare = $params->get('activeShare', 0)) {
    $position                = $params->get('position', 'left');
    $numPreferredServices    = $params->get('numPreferredServices', 5);
    $postShareTitle          = addslashes($params->get('postShareTitle', JText::_('MOD_JBOX_ADDTHIS_POST_SHARE_TITLE')));
    $postShareFollowMsg      = addslashes($params->get('postShareFollowMsg', JText::_('MOD_JBOX_ADDTHIS_POST_SHARE_FOLLOW_MESSAGE')));
    $postShareRecommendedMsg = addslashes($params->get('postShareRecommendedMsg', JText::_('MOD_JBOX_ADDTHIS_POST_SHARE_RECOMMAND_MESSAGE')));
    $script .= <<<EOQ
'share' : {'position' : '{$position}','numPreferredServices' : {$numPreferredServices},'postShareTitle' : '{$postShareTitle}','postShareFollowMsg' : '{$postShareFollowMsg}','postShareRecommendedMsg' : '{$postShareRecommendedMsg}'}, 
EOQ;
}

// if Follow is active :
if($activeFollow = $params->get('activeFollow', '0')) {
    $postFollowRecommendedMsg = addslashes($params->get('postFollowRecommendedMsg', JText::_('MOD_JBOX_ADDTHIS_POST_FOLLOW_RECOMMAND')));
    $postFollowTitle          = addslashes($params->get('postFollowTitle', JText::_('MOD_JBOX_ADDTHIS_POST_FOLLOW_TITLE')));
    $facebook                 = $params->get('facebook', null);
    $facebookId               = addslashes($params->get('facebookId', null));
    $twitter                  = $params->get('twitter', null);
    $twitterId                = addslashes($params->get('twitterId', null));
    $google                   = $params->get('google', null);
    $googleId                 = addslashes($params->get('googleId', null));
    $linkedin                 = $params->get('linkedin', null);
    $linkedinId               = addslashes($params->get('linkedinId', null));
    $script .= <<<EOQ
'follow' : {'services' : [
EOQ;
    if($facebook && !empty($facebookId))
        $script .= "{'service': 'facebook', 'id': '" . $facebookId . "'},";
    if($twitter && !empty($twitterId))
        $script .= "{'service': 'twitter', 'id': '" . $twitterId . "'},";
    if($google && !empty($googleId))
        $script .= "{'service': 'google_follow', 'id': '" . $googleId . "'},";
    if($linkedin && !empty($linkedinId))
        $script .= "{'service': 'linkedin', 'id': '" . $linkedinId . "'},";
    
    $script .= <<<EOQ
],'postFollowTitle' : '{$postFollowTitle}','postFollowRecommendedMsg' : '{$postFollowRecommendedMsg}'}
EOQ;
}

// rendering parameters :
$maxWidth = $params->get('responsiveMaxWidth', '970px');
$minWidth = $params->get('responsiveMinWidth', '0px');
$theme    = $params->get('theme', 'transparent');

// script finalization :
$script = "addthis.layers({'theme' : '" . $theme . "', 'responsive' : {'maxWidth': '$maxWidth','minWidth': '$minWidth'}," . $script . "  });";
$JS = "\n\njQuery(document).ready(function(){";
$JS .= $script;
$JS .= "\n});";

// adds the script declaration to Joomla!
$document->addScriptDeclaration($JS);

?>