<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_project');
    }

    private function rules()
    {
        return [
            'title' => 'required',
            // 'cover_image' => 'required',
            'project_year' => 'required',
            'project_area' => 'required',
            'client_name' => 'required',
            'desc' => 'required',
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
