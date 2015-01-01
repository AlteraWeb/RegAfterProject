<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=projects.add.tags
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');
require_once cot_incfile('auth');
require_once cot_incfile('forms');

/* === Hook === */
foreach (cot_getextplugins('users.register.first') as $pl)
{
	include $pl;
}
/* ===== */

$t1 = new XTemplate(cot_tplfile('regafterproject.form', 'plug'));



$t1->assign(array(
	'USERS_REGISTER_TITLE' => $L['aut_registertitle'],
	'USERS_REGISTER_SUBTITLE' => $L['aut_registersubtitle'],
	'USERS_REGISTER_ADMINEMAIL' => $cot_adminemail,
	'USERS_REGISTER_SEND' => cot_url('users', 'm=register&a=add'),
	'USERS_REGISTER_USER' => cot_inputbox('text', 'rusername', $ruser['user_name'], array('size' => 24, 'maxlength' => 100)),
	'USERS_REGISTER_EMAIL' => cot_inputbox('text', 'ruseremail', $ruser['user_email'], array('size' => 24, 'maxlength' => 64)),
	'USERS_REGISTER_PASSWORD' => cot_inputbox('password', 'rpassword1', '', array('size' => 12, 'maxlength' => 32)),
	'USERS_REGISTER_PASSWORDREPEAT' => cot_inputbox('password', 'rpassword2', '', array('size' => 12, 'maxlength' => 32)),
	'USERS_REGISTER_COUNTRY' => cot_selectbox_countries($ruser['user_country'], 'rcountry'),
	'USERS_REGISTER_TIMEZONE' => cot_selectbox_timezone($ruser['user_timezone'], 'rusertimezone'),
	'USERS_REGISTER_BIRTHDATE' => cot_selectbox_date(0, 'short', 'ruserbirthdate', cot_date('Y', $sys['now']), cot_date('Y', $sys['now']) - 100, false),
));

// Error and message handling
cot_display_messages($t);


/* === Hook === */
foreach (cot_getextplugins('users.register.tags') as $pl)
{
	include $pl;
}
/* ===== */


$t1->parse("MAIN");

$t->assign('REGAFTERPROJECT', $t1->text("MAIN"));