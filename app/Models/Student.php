<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'Classroom_id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalitie_id');
    }
    public function myparent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');

    }
    public function attendance()
    {
        return $this->hasMany(AttendanceStudent::class, 'student_id');
    }
}
