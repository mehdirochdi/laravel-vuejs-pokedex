<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['poke_name', 'poke_id', 'user_id'];

    ////////////////////////////////////////////////////////////////////////////
    //                                 RELATIONSHIPS
    ////////////////////////////////////////////////////////////////////////////
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    ////////////////////////////////////////////////////////////////////////////
    //                             MUTATOR AND ACCESSOR
    ////////////////////////////////////////////////////////////////////////////
    

    ////////////////////////////////////////////////////////////////////////////
    //                                  FUNCTIONS
    ////////////////////////////////////////////////////////////////////////////
    public static function getPokeCatchIds() {
        return Collection::select('poke_id')->where('user_id', 1)->get();
    }
    ////////////////////////////////////////////////////////////////////////////
    //                                  SCOPES
    ////////////////////////////////////////////////////////////////////////////
}
