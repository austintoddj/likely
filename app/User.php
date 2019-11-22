<?php namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'website', 'location'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * DEFINE RELATIONSHIP
     *
     * A User HAS MANY Statuses
     */
    public function status() {
        return $this->hasMany('Statuses');
    }

    /**
     * DEFINE RELATIONSHIP
     *
     * A User HAS MANY Likes
     */
    public function likes() {
        return $this->hasMany('Likes');
    }

    /**
     * Fetch a user by their id.
     *
     * @param $id
     *
     * @return mixed|null
     */
    public static function findById($id) {
        return User::find($id);
    }

    /**
     * Find the following relationships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows() {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Determine if current user follows another user.
     *
     * @param \App\User $otherUser
     *
     * @return bool
     */
    public function isFollowedBy(User $otherUser) {

        $idsWhoOtherUserFollows = $otherUser->follows()->lists('followed_id');
        return in_array($this->id, $idsWhoOtherUserFollows);
    }

    public static function followers($user) {
        $idsWhoOtherUserFollows = $user->follows()->lists('followed_id');
        return $idsWhoOtherUserFollows;
    }

    /**
     * Get the news feed for a non-authenticated user.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public static function getFeedForUser(User $user) {

        $userIds   = $user->follows()->lists('followed_id');
        $userIds[] = Auth::user()->id;

        return Statuses::whereIn('user_id', $userIds)->latest()->get();
    }

    /**
     * Get the news feed for the authenticated user.
     *
     * @return int
     */
    public static function authUserStatus() {

        $statuses = Auth::user()->status()->latest()->get();
        return count($statuses);
    }

}
