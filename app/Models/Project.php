<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = [];

    protected $data = ['delete_at'];
    public $timestamps = true;


    public function client(){

        return $this->belongsTo(Client::class,'client_id','id');
    }
    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }


}
