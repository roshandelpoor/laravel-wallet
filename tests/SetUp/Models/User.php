<?php

namespace Tests\SetUp\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 
        'email'
    ];
}
