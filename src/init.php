<?php
/**
 * @package      Prism
 * @subpackage   Initialization
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

if (!defined('PRISM_PATH_LIBRARY')) {
    define('PRISM_PATH_LIBRARY', JPATH_LIBRARIES . '/Prism');
}

if (!defined('PRISM_PATH_UI_LAYOUTS')) {
    define('PRISM_PATH_UI_LAYOUTS', PRISM_PATH_LIBRARY . '/ui/layouts');
}

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.path');

JLoader::registerNamespace('Prism', JPATH_LIBRARIES);

JLoader::registerNamespace('Abraham', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('AdamPaterson', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Carbon', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Coinbase', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Defuse', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Facebook', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Google', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('JmesPath', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('League', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Monolog', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Psr', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('RandomLib', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('SecurityLib', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('Ramsey', PRISM_PATH_LIBRARY . '/vendor');
JLoader::registerNamespace('GraphQL', PRISM_PATH_LIBRARY . '/vendor');

// Register some helpers.
JHtml::addIncludePath(PRISM_PATH_LIBRARY . '/ui/helpers');

// Load library language.
$lang = JFactory::getLanguage();
$lang->load('lib_prism', PRISM_PATH_LIBRARY);
