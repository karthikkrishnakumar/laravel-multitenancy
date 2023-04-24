<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Models\Tenant;

class CustomTenant extends Tenant
{
    use HasFactory;
    protected $table = 'tenants';
    protected $fillable = [
        'name',
        'domain',
        'database',
    ];

    // protected static function booted()
    // {
    //     static::creating(fn(CustomTenant $model) => $model->createDatabase());
    // }

    // public function createDatabase()
    // {
    //      $tenants=CustomTenant::all();
    //     foreach($tenants as $tenant)
    //       DB::statement("CREATE DATABASE `$tenant->database`");
    // }
}
