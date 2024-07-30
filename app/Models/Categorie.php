<?php

namespace App\Models;

use App\Models\Tache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];


     // Relation avec les tâches
    public function taches()
    {
        return $this->hasMany(Tache::class, 'categorie_id');
    }
}
