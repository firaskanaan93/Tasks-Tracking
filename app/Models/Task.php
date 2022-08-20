<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Task
 *
 * @property integer $id
 * @property integer $assigned_to_id
 * @property integer $assigned_by_id
 * @property string $title
 * @property string $description
 * @property User $admin
 * @property User $user
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin Builder
 */
class Task extends Model
{
    protected $fillable = ['title','description','assigned_to_id','assigned_by_id'];

    public function admin(){
        return $this->belongsTo(User::class,'assigned_by_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'assigned_to_id');
    }
}
