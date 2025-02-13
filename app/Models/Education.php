<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'institution_name', 'degree', 'year'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

