<?php

namespace App\Controllers;

use App\Models\User;

class UserControllers extends BaseController {

    /**
     * @return string
     */
    public function getIndex(){
        return 'User Index';
    }

}