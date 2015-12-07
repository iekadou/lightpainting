<?php
namespace Iekadou\Webapp;
require_once("../inc/include.php");


$Image = new Image();
$id = (isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false);
$Image = $Image->get_by(array(array("id", "=", $id), array("userid", "=", Account::get_user_id())));

if ($Image == false) {
    raise404();
    die();
}


new View('Image', Translation::translate('Image'), "image.html");
Globals::set_var('Image', $Image);

View::render();
