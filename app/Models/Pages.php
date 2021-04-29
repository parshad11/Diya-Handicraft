<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected function checkstatic($id)
    {
        $statId = $id;
        $pagearray = array('1', '2', '3', '4', '5');
        for ($i = 0; $i < count($pagearray); $i++) {
            if ($pagearray[$i] == $statId) {
                return false;
            }
        }
        return true;
    }
}