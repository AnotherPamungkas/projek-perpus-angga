<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * @property \Illuminate\Database\Eloquent\Collection $favoritBuku
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'role'
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

    public function profil()
    {
        return $this->hasOne(Profil::class, 'peminjam_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'peminjam_id');
    }

    public function favoritBuku()
    {
        return $this->belongsToMany(
            \App\Models\Buku::class,
            'buku_favorit',
            'peminjam_id',
            'buku_id'
        );
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'peminjam_id');
    }

    public function denda()
    {
        return $this->hasMany(Denda::class, 'user_id');
    }
}
