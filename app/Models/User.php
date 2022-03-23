<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

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
    
    public function scopeWithWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
        ->with([$relation => $constraint]);
    }
    
    public function followers()
    {
        return $this->belongsToMany(Self::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(Self::class, 'followers', 'follower_id', 'user_id');
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
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
    
    
}
