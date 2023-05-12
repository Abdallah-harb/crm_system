<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'clients';
    protected $guarded = [];

    protected $data = ['delete_at'];
    public $timestamps = true;


    public function prject(){

        return $this->hasMany(Project::class,'client_id','id');
    }
}
