<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',  
        'gender',
        'points',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promote()
    {
        if ($this->gender === 'Male') {
            $this->points += 10;
        } elseif ($this->gender === 'Female') {
            $this->points += 5;
        }

        $this->save(); 
    }

    public function demote()
    {
        if ($this->gender === 'Male') {
            $this->points -= 5;
        } elseif ($this->gender === 'Female') {
            $this->points -= 2;
        }

        $this->save();
    }
}