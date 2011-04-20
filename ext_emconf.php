<?php

########################################################################
# Extension Manager/Repository config file for ext "vhc".
#
# Auto generated 20-04-2011 21:46
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'View Helper Collection',
	'description' => 'An extension to provide several new- or backported viewhelpers for the usage in different extensions',
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
	'version' => '0.3.0',
	'_md5_values_when_last_written' => 'a:12:{s:12:"ext_icon.gif";s:4:"b4e6";s:41:"Classes/ViewHelpers/CommentViewHelper.php";s:4:"25f4";s:39:"Classes/ViewHelpers/CountViewHelper.php";s:4:"5199";s:42:"Classes/ViewHelpers/FileiconViewHelper.php";s:4:"d99c";s:45:"Classes/ViewHelpers/PagebrowserViewHelper.php";s:4:"0ff6";s:44:"Classes/ViewHelpers/Format/AgeViewHelper.php";s:4:"db5b";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"1e87";s:49:"Classes/ViewHelpers/Format/FilesizeViewHelper.php";s:4:"1dd4";s:57:"Classes/ViewHelpers/Format/HtmlSpecialCharsViewHelper.php";s:4:"adb4";s:50:"Classes/ViewHelpers/Format/StripTagsViewHelper.php";s:4:"e616";s:54:"Classes/ViewHelpers/Link/TelephoneNumberViewHelper.php";s:4:"8b1c";s:39:"Documentation/API/OpenOffice/en/API.sxw";s:4:"be5c";}',
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