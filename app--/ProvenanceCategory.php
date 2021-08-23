<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvenanceCategory extends Model
{
    protected $guarded = [];
    public function provenances()
    {
        return $this->hasMany(Provenance::class, 'provenance_id');
    } //end of provenances

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_id');
    } //end of categories


}
