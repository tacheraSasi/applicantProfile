<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'skill_name'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

