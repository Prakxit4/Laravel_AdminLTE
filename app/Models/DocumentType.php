<?php

namespace App\Models;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
