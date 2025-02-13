<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'company_name', 'role', 'duration'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

