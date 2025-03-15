<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryUser extends Model
{
    protected $fillable = ['name', 'email', 'registration_number'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
