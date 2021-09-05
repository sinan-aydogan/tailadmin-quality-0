<?php

namespace App\Relations;
trait GetRelatedData {

    public static function scopeRelatedData($query,$key,$table){
       return $query->whereIn('id',function($query)use($key,$table){
        $query->select($key)
        ->from($table)
        ->distinct();
    });
    }
}
