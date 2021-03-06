<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}