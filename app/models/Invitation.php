<?php
/**
 * Created by PhpStorm.
 * User: Adolfo
 * Date: 19/12/2017
 * Time: 17:58
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Invitation extends Model{

    protected $table = "invitations";
    protected $fillable = ['email','used'];

}