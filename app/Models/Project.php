<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function nrn_project()
    {
        return $this->hasOne(NrnaProject::class, 'project_id');
    }
    public function third_party_project()
    {
        return $this->hasOne(ThirdPartyProject::class, 'project_id');
    }
}
