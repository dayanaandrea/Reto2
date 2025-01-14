<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    // Un usuario puede tener un único rol
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'pin',
        'address',
        'phone1',
        'phone2',
        'photo',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function teacherSchedules()
    {
        return $this->hasManyThrough(Schedule::class, Module::class);
    }

    public function studentSchedules()
    {
        return $this->hasManyThrough(Schedule::class, Enrollment::class, 'user_id', 'module_id', 'id', 'module_id');
    }

    public function teacherMeetings()
    {
        return $this->hasMany(Meeting::class, 'teacher_id');
    }

    public function studentMeetings()
    {
        return $this->hasMany(Meeting::class, 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
