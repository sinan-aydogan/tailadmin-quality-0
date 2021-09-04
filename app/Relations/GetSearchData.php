<?php

namespace App\Relations;
trait GetSearchData {

    public static function scopeSearchData($query,$key,$table){
       return $query->whereIn('id',function($query)use($key,$table){
        $query->select($key)
        ->from($table)
        ->distinct();
    });
    }
}
