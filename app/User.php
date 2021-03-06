<?php

namespace Reporthero;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'last_name', 'klaviyo_api', 'store_type', 'settings'
    ];

    protected $casts = [
        'verified' => 'boolean',
        'activated' => 'boolean',
        'banned' => 'boolean',
        'on_trial' => 'boolean',
        'subscribed' => 'boolean',
        'settings' => 'array',
        'klaviyo_api' => 'array',
        // this will show hidden attributes when set true
        'public' => 'boolean'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'klaviyo_api',
    ];

    // We need to Decode and Encode klaviyo Api since it is hidden

    public function toJson($options = 0) {
    $this->setAttributeVisibility(); // set visibility stuff here
    return parent::toJson();
    }
    public function toArray() {
    $this->setAttributeVisibility(); // set visibility stuff here
    return parent::toArray();
    }

    public function setAttributeVisibility(){
        if($this->public){
            $this->setVisible(['id', 'klaviyo_api', 'password']);
        }
    }

    public function checkAdminRole($roles)
    {
        if (\Bouncer::is($this)->an('admin')) {
            return true;
        }
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (\Bouncer::is($this)->notAn('admin')) {
                    return false;
                }
            }
            return true;
        }
    }
}
