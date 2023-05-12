<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'tasks';

    protected $guarded = [];

    protected $data = ['delete_at'];

    public $timestamps = true;


    public function project(){

        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }

}
