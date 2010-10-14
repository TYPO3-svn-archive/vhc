<?php

########################################################################
# Extension Manager/Repository config file for ext "vhc".
#
# Auto generated 14-10-2010 22:33
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'View Helper Collection',
	'description' => 'An extension to provide several viewhelpers for the usage in different extensions',
	'category' => 'misc',
	'shy' => 0,
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => 0,
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'Daniel Regelein',
	'author_email' => 'Daniel.Regelein@diehl-informatik.de',
	'author_company' => 'DIEHL Informatik GmbH',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.2.0',
	'_md5_values_when_last_written' => 'a:9:{s:12:"ext_icon.gif";s:4:"b4e6";s:42:"Classes/ViewHelpers/FileiconViewHelper.php";s:4:"bb9b";s:45:"Classes/ViewHelpers/PagebrowserViewHelper.php";s:4:"0ff6";s:44:"Classes/ViewHelpers/Format/AgeViewHelper.php";s:4:"210f";s:49:"Classes/ViewHelpers/Format/FilesizeViewHelper.php";s:4:"97c0";s:57:"Classes/ViewHelpers/Format/HtmlSpecialCharsViewHelper.php";s:4:"adb4";s:50:"Classes/ViewHelpers/Format/StripTagsViewHelper.php";s:4:"e616";s:54:"Classes/ViewHelpers/Link/TelephoneNumberViewHelper.php";s:4:"8b1c";s:39:"Documentation/API/OpenOffice/en/API.sxw";s:4:"58ff";}',
	'constraints' => array(
		'depends' => array(
			'extbase' => '1.2.0-0.0.0',
			'fluid' => '1.2.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
);

?>