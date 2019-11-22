<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Statuses extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id'];

    /**
     * DEFINE RELATIONSHIP
     *
     * A Status BELONGS TO a User
     */
    public function user() {
        return $this->belongsTo('User');
    }

    /**
     * DEFINE RELATIONSHIP
     *
     * A Status HAS MANY Likes
     */
    public function likes() {
        return $this->hasMany('Likes');
    }

    /**
     * DEFINE RELATIONSHIP
     *
     * A Status HAS MANY Comments
     */
    public function comments() {
        return $this->hasMany('Comments');
    }

    /**
     * Fetch a status by its id.
     *
     * @param $id
     *
     * @return mixed|null
     */
    public static function findById($id) {
        return Likes::find($id);
    }

    public static function isLikedBy($user, $status_id) {
        $found_like = Likes::where('liker_id', '=', $user)->where('status_id', '=', $status_id)->get();

        if ($found_like->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Get the number of likes for a status.
     *
     * @param $liked_id
     *
     * @return int
     */
    public static function numLikes($liked_id) {
        $likes = Likes::where('status_id', '=', $liked_id)->get();
        return count($likes);
    }

    public static function commentedOn($status_id) {
        $found_status = Comments::where('status_id', '=', $status_id)->get();
        return $found_status;
    }

    public static function numComments($status_id) {
        $comments = Comments::where('status_id', '=', $status_id)->get();
        return count($comments);
    }

    public static function isCommentedOn($status_id) {
        $found_comment = Comments::where('status_id', '=', $status_id)->get();

        if ($found_comment->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

}
