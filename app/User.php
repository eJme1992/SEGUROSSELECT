<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function roles() {
		return $this->belongsToMany('App\Role');
	}

	public function AutorizarRoles($roles) {
		if ($this->hasAnyRole($roles)) {
			return true;
		}
		abort(401, 'Su rol no esta autorizado');
	}

	public function hasAnyRole($roles) {
		if (is_array($roles)) {
			foreach ($roles as $key) {
				if ($this->hasRole($key)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
		}
		return false;
	}

	public function hasRole($role) {
		if ($this->roles()->where('name', $role)->first()) {
			return true;
		} else {
			return false;
		}
	}
}
