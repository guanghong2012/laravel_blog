<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    //指定主键
    protected $primaryKey = 'id';

    //指定不允许批量赋值的字段 为空则表示没有
    protected $guarded = [];
}
