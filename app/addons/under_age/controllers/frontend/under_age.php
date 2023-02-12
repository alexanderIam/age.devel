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

use Tygh\Enum\UserTypes;

defined('BOOTSTRAP') or die('Access denied');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if($mode == 'verify' && defined('AJAX_REQUEST')){

        $birthday = !empty($_REQUEST['birthday']) ? fn_parse_date($_REQUEST['birthday']) : 0;
        $user_age = fn_calculate_user_age($birthday);
        $is_legal_age = fn_check_age($user_age);
        fn_set_user_age_type($is_legal_age);

        Tygh::$app['ajax']->assign('force_redirection', fn_url());
        return [CONTROLLER_STATUS_OK];
    }
}

$user_type = Tygh::$app['session']['auth']['user_type'];
$under_age_type = fn_get_cookie('under_age_type');
if($user_type !== UserTypes::ADMIN && empty($under_age_type)){

    if(Tygh::$app['session']['auth']['user_id'] === 0){
        fn_set_cookie('under_age_type', 'verify');

    }else{
        $user_age = Tygh::$app['session']['auth']['user_age'];
        $is_legal_age = fn_check_age($user_age);
        fn_set_user_age_type($is_legal_age);
    }
    Tygh::$app['view']->assign('under_age_type', fn_get_cookie('under_age_type'));
    header('Location: ../index.php');
}
Tygh::$app['view']->assign('under_age_type', fn_get_cookie('under_age_type'));
