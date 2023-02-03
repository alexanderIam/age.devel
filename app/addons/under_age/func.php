<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

 use Tygh\Registry;

/**
 * Hook handler for "user_init"
 *
 * Actions performed:
 *     - Adds user age to the session.
 *
 * @param array     $session
 *
 * @return void
 */
 function fn_under_age_user_init(&$session, $user_info, $first_init)
 {
    $user_age = fn_get_user_age($session['user_id']);
	$session['user_age'] = $user_age;
 }

/**
* Get user age from DB
*
*@param integer     $user_id
*
*@return integer    User's age
*/
function fn_get_user_age($user_id)
{
    if (!empty($user_id)) {
        $birthday = db_get_field('SELECT birthday FROM ?:users WHERE user_id = ?i', $user_id);
        $user_age = fn_calculate_user_age($birthday);
        return $user_age;
    }
    return 0;
}

/**
* Calculate user age
*
*@param integer     $birthday
*
*@return integer    User age
*/
function fn_calculate_user_age($birthday)
{
	if (!empty($birthday)) {
		$year = date('Y', $birthday);
		$month = date('m-d', $birthday);

		$_year = date('Y', TIME);
		$_month = date('m-d', TIME);

		$user_age = $_year - $year;

		if ($month > $_month) {
			$user_age--;
		}
		return $user_age;
	}
    return 0;
} 
 
/**
 * Check if user age is valid
 *
 * @param integer   $user_age
 * 
 * @return boolean  True if user age is valid, false otherwise
 */
function fn_check_age($user_age)
{
	$minimal_age = Registry::get('addons.under_age.minimal_age');
    $minimal_age = is_numeric($minimal_age) ? $minimal_age : 0;

    return $user_age >= $minimal_age;
}

/**
 * Set user cookie to access web site according to age
 *
 * @param boolean $birthday True if user's age valid
 */
function fn_set_user_age_type($is_legal_age)
{
    if($is_legal_age){
        fn_set_cookie('under_age_type', 'allow');

    }else{
        fn_set_cookie('under_age_type', 'deny');
    }         
}
