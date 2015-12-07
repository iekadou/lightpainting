<?php
namespace Iekadou\Webapp;
require_once("../../inc/include.php");

$Image = new Image();
$img_path = (isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false);
if ($img_path != false) {
    $Image = $Image->get_by(array(array("id", "=", $img_path), array("userid", "=", Account::get_user_id())));
    Globals::set_var('form_method', 'PUT');
} else { 
    Globals::set_var('form_method', 'POST');
}
    Globals::set_var('Image', $Image);
if (Account::is_logged_in() != true || !$Image) {
    raise404();
    die();
}

new View('Image', Translation::translate('Image'), 'account/image.html');
Globals::set_var('dashboard_active', true);
View::render();
