<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoom extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Class'];
    use HasFactory;
    protected $fillable = ['Name_Class', 'grade_id'];
    public function grades(): BelongsTo
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
}
