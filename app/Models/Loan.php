<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    protected $fillable = ['library_user_id', 'book_id', 'due_date', 'status'];

    public function user()
    {
        return $this->belongsTo(LibraryUser::class, 'library_user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
