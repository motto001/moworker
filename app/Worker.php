<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{

 //   use \Illuminate\Database\Eloquent\SoftDeletes;
  //  protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'fullname'];
   
 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
  
}
