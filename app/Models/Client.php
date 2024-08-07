<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Client extends Model implements HasMedia
{
    protected $guarded = [];

    use HasFactory, InteractsWithMedia;

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    private function rules()
    {
        return [
            'name' => 'required',
            'testimonial' => 'required',
            'testimonial_giver' => 'required',
            'testimonial_giver_position' => 'required',
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
