<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Treatment extends Model
{
    use HasFactory; // If you haven't added this yet

    protected $fillable = ['name', 'dosage']; // Removed 'prescription_id'

    public function prescriptions(): BelongsToMany
    {
        return $this->belongsToMany(Prescription::class, 'prescription_treatments')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}