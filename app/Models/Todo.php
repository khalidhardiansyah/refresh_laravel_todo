<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    //
    use HasFactory;

    protected $table = 'todos';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'todo',
        'user_id'
    ];

    // public function users() : HasOne {
        
    //     return $this->hasOne(User::class);
    // }

}
