<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Section'];
    use HasFactory;
    protected $fillable = ['Name_Section' , 'grade_id', 'class_id'];
    public function classes(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class,'class_id');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'teacher_section');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
