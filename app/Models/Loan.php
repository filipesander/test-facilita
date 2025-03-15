<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    protected $fillable = ['library_user_id', 'book_id', 'loan_date', 'return_date', 'status'];

    // Relacionamento correto com LibraryUser
    public function libraryUser()
    {
        return $this->belongsTo(LibraryUser::class, 'library_user_id');
    }

    // Relacionamento com Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
