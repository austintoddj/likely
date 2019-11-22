<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['liker_id', 'status_id'];

    /**
     * DEFINE RELATIONSHIP
     *
     * A Like BELONGS TO a Status
     */
    public function status() {
        return $this->belongsTo('Statuses');
    }

}
