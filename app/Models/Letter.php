<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Letter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'letter_type_id',
        'letter_perihal',
        'recipients',
        'content',
        'attachment',
        'notulis'
    ];

    protected $casts = [
        'recipients' => 'array',
    ];
    /**
     * Get the kla that owns the Letter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function klasifikasi()
    {
        return $this->belongsTo(Letter_type::class, 'letter_type_id', 'id');
    }

    public function ntls()
    {
        return $this->belongsTo(User::class, 'notulis', 'id');
    }

    public function rslt()
    {
        return $this->hasOne(Result::class, 'letter_id', 'id');
    }
}
