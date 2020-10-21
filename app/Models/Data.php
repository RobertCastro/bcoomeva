<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ["name", "dni", "number_table", 'key'];

    public function scopeFilter(Builder $query, array $filters)
    {
        if (!request("page")) {
            session()->put("search", $filters['search'] ?? null);
            session()->put("trashed", $filters['trashed'] ?? null);
        }
        $query->when(session("search"), function ($query, $search) {
            $query->where('dni', 'LIKE', '%' . $search . '%');
        })->when(session("trashed"), function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
