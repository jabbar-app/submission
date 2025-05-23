<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'name',
        'email',
        'phone',
        'team_members',
        'problems',
        'solutions',
        'target_beneficiaries',
        'unique_value',
        'key_features',
        'funding_needs',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
