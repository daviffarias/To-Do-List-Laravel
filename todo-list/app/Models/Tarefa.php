<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    // Permitir mass assignment dos seguintes atributos
    protected $fillable = ['titulo', 'descricao', 'concluida'];
}
