<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_code', 
        'name_type',
    ];

    /**
     * Get all of the surat_tertaut for the Letter_type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function letter()
    {
        return $this->hasMany(Letter::class, 'letter_type_id', 'id');
    }
}
