<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class,'tag_project');
    }

    private function rules()
    {
        return [
            'tags' => 'required',
            'project_id' => 'nullable',
        ];
    }

    public function storeRules()
    {
        return $this->rules();
    }

    public function updateRules()
    {
        //for situations where you need to override some rules for update
        $rules = array_merge($this->rules(), []);
        return $this->rules();
    }

}
