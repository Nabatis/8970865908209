<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['id_buku', 'id_users', 'is_bookmarked'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
