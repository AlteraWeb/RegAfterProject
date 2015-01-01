<?php

function cot_regafterproject_import($source = 'POST', $ritem = array(), $auth = array()) {
    global $cfg, $db_projects, $cot_extrafields, $usr, $sys;

    $ritem['rusername'] = cot_import('rusername', $source, 'TXT');
    $ritem['ruseremail'] = cot_import('ruseremail', $source, 'TXT');
    $ritem['rpassword1'] = cot_import('rpassword1', $source, 'HTM');
    $ritem['rpassword2'] = cot_import('rpassword2', $source, 'TXT');

    return $ritem;
}

/**
 * Validates project data.
 * @param  array   $ritem Imported project data
 * @return boolean        TRUE if validation is passed or FALSE if errors were found
 */
function cot_regafterproject_validate($ritem) {
    global $cfg, $structure, $db, $db_users, $ruser, $rpassword1, $rpassword2;
    
    
    
    $user_exists = (bool) $db->query("SELECT user_id FROM $db_users WHERE user_name = ? LIMIT 1", array($ruser['user_name']))->fetch();
    $email_exists = (bool) $db->query("SELECT user_id FROM $db_users WHERE user_email = ? LIMIT 1", array($ruser['user_email']))->fetch();

    if (preg_match('/&#\d+;/', $ruser['user_name']) || preg_match('/[<>#\'"\/]/', $ruser['user_name']))
        cot_error('aut_invalidloginchars', 'rusername');
    if (mb_strlen($ruser['user_name']) < 2)
        cot_error('aut_usernametooshort', 'rusername');
    if (mb_strlen($rpassword1) < 4)
        cot_error('aut_passwordtooshort', 'rpassword1');
    if (!cot_check_email($ruser['user_email']))
        cot_error('aut_emailtooshort', 'ruseremail');
    if ($user_exists)
        cot_error('aut_usernamealreadyindb', 'rusername');
    if ($email_exists && !$cfg['useremailduplicate'])
        cot_error('aut_emailalreadyindb', 'ruseremail');
    if ($rpassword1 != $rpassword2)
        cot_error('aut_passwordmismatch', 'rpassword2');

    return !cot_error_found();
}
