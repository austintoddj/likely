<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['follower_id', 'followed_id'];

}
