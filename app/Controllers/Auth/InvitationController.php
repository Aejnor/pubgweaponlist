<?php
/**
 * Created by PhpStorm.
 * User: Adolfo
 * Date: 19/12/2017
 * Time: 17:53
 */

namespace App\Controllers\Auth;


use App\Controllers\BaseController;
use App\Models\Invitation;
use Sirius\Validation\Validator;

class InvitationController extends BaseController {

    public function getInvitation(){
        return $this->render('auth/invitation.twig',[]);
    }

    public function postInvitation(){
        $errors = [];
        $validator = new Validator();

        $validator->add('inputEmail:Email', 'email',[],'El email no es valido');
        $validator->add('inputEmail:Email', 'required', [],'El {label} es obligatorio');


        if ($validator->validate($_POST)){
            $invitation = new Invitation();

            $invitation->email = $_POST['inputEmail'];
            $invitation->used = 0;

            $invitation->save();

        }else{
            $errors = $validator->getMessages();
        }

        return $this->render('auth/invitation.twig',['errors' => $errors]);

    }





}