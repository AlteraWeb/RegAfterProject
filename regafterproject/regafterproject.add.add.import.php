<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=projects.add.add.import
[END_COT_EXT]
==================== */
defined('COT_CODE') or die('Wrong URL');

$ruser['user_name'] = cot_import('rusername', 'P', 'TXT', 100, TRUE);
$ruser['user_email'] = cot_import('ruseremail', 'P', 'TXT', 64, TRUE);
$rpassword1 = cot_import('rpassword1', 'P', 'HTM', 32);
$rpassword2 = cot_import('rpassword2', 'P', 'HTM', 32);
$ruser['user_country'] = cot_import('rcountry', 'P', 'TXT');
$ruser['user_timezone'] = cot_import('rusertimezone', 'P', 'TXT');
$ruser['user_timezone'] = (!$ruser['user_timezone']) ? $cfg['defaulttimezone'] : $ruser['user_timezone'];
$ruser['user_gender'] = cot_import('rusergender', 'P', 'TXT');
$ruser['user_email'] = mb_strtolower($ruser['user_email']);


require_once cot_incfile('users', 'module');
require_once cot_incfile('regafterproject', 'plug');

$reg_user = cot_regafterproject_import('POST', array(), $usr);

cot_regafterproject_validate($reg_user);


if (!cot_error_found())
{
    $uid = cot_add_user($ruser, $reg_user['ruseremail'], null, $reg_user['rpassword1'], 7, true);
    $usr = cot_user_data($uid);
   
    $ritem['item_userid'] = $uid;
    $ritem['item_state'] = 0;
} 