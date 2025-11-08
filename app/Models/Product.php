<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'price', 'description'];

    /**
     * Get the indexable data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'created_at' => $this->created_at->timestamp,
        ];
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'products';
    }

    /**
     * Get the Typesense schema for the model.
     * Scoutning yangi versiyasida bu metod avtomatik ishlatiladi
     */
    protected function makeAllSearchableUsing($query)
    {
        return $query->with([]); // Kerakli relationlarni qo'shing
    }
}
