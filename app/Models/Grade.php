<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['Name','Notes'];
    use HasFactory;
    protected $fillable = ['Name' , 'Notes'];
    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}
