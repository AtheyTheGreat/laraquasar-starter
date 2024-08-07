<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded;
    
    use HasFactory;


    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    private function rules()
    {
        return [
            'file' => 'required'
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
