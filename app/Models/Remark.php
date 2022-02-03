<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $fillable = ['description','remarkable_id','remarkable_type'];

    public function airlines()
    {
        return $this->morphedByMany(Airline::class, 'remarkable');
    }
 
    public function airports()
    {
        return $this->morphedByMany(Airport::class, 'remarkable');
    }

    public function flights()
    {
        return $this->morphedByMany(Flight::class, 'remarkable');
    }
}
