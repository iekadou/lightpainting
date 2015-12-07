<?php
namespace Iekadou\Webapp;
require_once("../../inc/include.php");

try {
    if (Account::is_logged_in() != true) {
        raise404();
        die();
    }

    $Image = new Image();

    if (!empty($errors)) {
        throw new ValidationError($errors);
    }

    switch (REQUEST_METHOD){
        case "PUT":
            $id = (isset($_POST['id']) ? htmlspecialchars($_POST['id']) : false);
            $Image = $Image->get_by(array(array("id", "=", $id), array("userid", "=", Account::get_user_id())));
            $Image = $Image->interpret_request($_POST, $_FILES);
            if ($Image == false) {
                raise404();
                die();
            }
            if ($Image->save()) {
                echo '{"url": "'.UrlsPy::get_url('account').'"}';
                die();
            }
            break;
        case "POST":
            if (Account::get_user()->is_activated() != true) {
                raise404();
                die();
            }
            $Image = $Image->set_userid(Account::get_user_id());
            $Image = $Image->interpret_request($_POST, $_FILES);
            if ($Image->create()) {
                echo '{"url": "'.UrlsPy::get_url('account').'"}';
                die();
            }
            break;
        default:
            raise404();
            die();
    }
    throw new ValidationError(array());
} catch (ValidationError $e) { echo $e->stringify(); die(); }
