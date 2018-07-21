<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Workerday extends Model
{
   // use SoftDeletes;
  //  protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workerdays';

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
    protected $fillable = ['worker_id', 'daytype_id', 'datum', 'managernote', 'workernote','pub'];
    /*
    public function workertime()
    {
        return $this->hasMany('App\Workertime');
    }
    public function chworkerday()
    {
        return $this->hasOne('App\Chworkerday');
    }*/
    public function worker()
    {
        return $this->belongsTo('App\Worker')->with('user');
    } 
    public function daytype()
    {
        return $this->belongsTo('App\Daytype');
    }
    
    
}
