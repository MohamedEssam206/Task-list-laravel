<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    #هنا بتقوله حطي الحاجات دي جوا الداتا بيز
    use HasFactory;
    protected $fillable =['title' ,'description' ,'long_description'];

    public function togglecomplete()
    {
        $this->completed = !$this ->completed;
        $this->save();
    }
}
