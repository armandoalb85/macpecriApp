<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    var $name="Total";

    protected $fillable = [
        'id', 'name',
    ];

    

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
