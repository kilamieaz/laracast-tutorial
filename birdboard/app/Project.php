<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = []; // yolo

    public function path()
    {
        return "/projects/{$this->id}";
    }
}
