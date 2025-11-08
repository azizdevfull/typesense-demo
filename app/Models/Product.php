<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'price', 'description', 'attribute_id'];

    /**
     * Get the indexable data array for the model.
     */
    public function toSearchableArray(): array
    {
        $array = [
            'id' => (string) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'created_at' => $this->created_at->timestamp,
        ];
        // Include data from related tags
        // $array['attribute'] = $this->attribute->pluck('name')->toArray(); // many
        $array['attribute'] = $this->attribute ? $this->attribute->name : null; // single

        return $array;
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
