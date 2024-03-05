<?php

namespace App\Filters;

class ItemFilter extends QueryFilter
{
    public function categories($cat_slug = null)
    {
        return $this->builder->whereHas('category', function ($query) use ($cat_slug) {
            $query->whereIn('slug', $cat_slug);
        });
    }

    public function tags($tag_slug = null)
    {
        return $this->builder->whereHas('tags', function ($query) use ($tag_slug) {
            $query->whereIn('slug', $tag_slug);
        });
    }

    public function collections($col_slug = null)
{
    return $this->builder->whereHas('collection', function ($query) use ($col_slug) {
        $query->whereIn('slug', $col_slug);
    });
}


}
