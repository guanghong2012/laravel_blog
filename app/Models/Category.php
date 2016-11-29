<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categorys';

    //指定主键
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * 指定允许批量赋值的字段
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //指定不允许批量赋值的字段
    protected $guarded = [];


}
