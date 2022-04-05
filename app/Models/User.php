<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
     /*
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    */
    protected $guarded = [
        'id'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    
    public function getRouteKeyName()
    {
        return "username";
    }
    
    public function scopeWithWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
        ->with([$relation => $constraint]);
    }
    
    public function followers($paginate = null)
    {
        if (!is_null($paginate)) {
            return $this->belongsToMany(Self::class, 'followers', 'user_id', 'follower_id')->paginate($paginate);
        }
        
        return $this->belongsToMany(Self::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings($paginate = null)
    {
        if (!is_null($paginate)) {
            return $this->belongsToMany(Self::class, 'followers', 'follower_id', 'user_id')->paginate($paginate);
        }
        
        return $this->belongsToMany(Self::class, 'followers', 'follower_id', 'user_id');
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function postsNew(bool $published = false, $pagination = null)
    {
        
        if (!is_null($published) && is_null($pagination)) {
            return $this->hasMany(Post::class)->latest()
                        ->where('published', $published)
                        ->get();
        }
        
        return $this->hasMany(Post::class)->latest()
                    ->where('published', $published)
                    ->paginate($pagination);
    }
    
    public function canJoinRoom($roomId)
    {
        $room = ChatRoom::find($roomId);
        
        return ($room->user_id_1 == Auth::id() || $room->user_id_2 == Auth::id()) ? true : false;
    }
    
    public function getRoom()
    {
        
        $room = ChatRoom::where('user_id_1', $this->id)->where('user_id_2', Auth::id())->first();
        
        if (empty($room)) {
            $room = ChatRoom::where('user_id_1', Auth::id())->where('user_id_2', $this->id)->first();
        }
        return $room;
    }
    
    public function chatRooms()
    {
        return ChatRoom::where('user_id_1', $this->id)
                       ->orWhere('user_id_2', $this->id)
                       ->orderBy('updated_at', 'DESC')
                       ->get();
    }
    
    protected function defaultProfilePhotoUrl()
    {
        //return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF&format=svg';
        return 'https://randomuser.me/api/portraits/women/'.strlen($this->username.$this->name).'.jpg';
        
    }
    
    public function followStatus()
    {
        if (auth()->check()) {
            $followers = $this->followers;
            $followings = $this->followings;
            
            if ($followers->count()) {
                foreach ($followers as $follower) {
                    if ($follower->id == auth()->id()) {
                        return 'Mengikuti';
                    }
                }
            } 
            
            if ($followings->count()) {
                foreach ($followings as $following) {
                    if ($following->id == auth()->id()) {
                        return "Ikuti Balik";
                    }
                }
            }
            
        }
        
        return 'Ikuti';
    }
    
    public function createOrDeleteFollower(User $user)
    {
        $follower = Follower::where('user_id', $this->id)
                         ->where('follower_id', $user->id)
                         ->first();
        
        if (empty($follower)) {
            $status = 'follow';
            // Create Follower
            $follow = Follower::create(['user_id' => $this->id, 'follower_id' => $user->id]);
            // Create Notifications
            $this->createOrDeleteNotificationUserFollow($status, $user, $follow);
        } else {
            $status = "unfollow";
            // Delete Notifications
            $this->createOrDeleteNotificationUserFollow($status, $user, $follower);
            // Delete Follower
            $follower->delete();
        }
        
        return $status;
    }
    
    public function createOrDeleteNotificationUserFollow(string $eventType, User $triggerUser, Follower $follow): void
    {
        if ($eventType == 'follow') {
            Notifications::updateOrCreate([
                'user_id'           =>  $this->id,
                'trigger_user_id'   =>  $triggerUser->id,
                'entity_id'         =>  $this->id,
                'entity_type'       =>  'user',
                'entity_event_id'   =>  $follow->id,
                'entity_event_type' =>  $eventType
            ]);
        } else {
            $notifyUserFollow = Notifications::where('trigger_user_id', $triggerUser->id)
                ->where('entity_id', $this->id)
                ->where('entity_type', 'user')
                ->where('entity_event_id', $follow->id)
                ->where('entity_event_type', 'follow')
                ->first();
            
            (!empty($notifyUserFollow)) ? $notifyUserFollow->delete() : '';
        }
    }
    
    
}
