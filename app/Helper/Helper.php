<?php

namespace app\Helper;

use Illuminate\Support\Str;

class Helper
{
    function pathGenerator($model, $title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        $allSlugs = $this->getRelatedSlugs($model, $slug, $id);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    /**
     * @param $slug
     * @param int $id
     * @return mixed
     */
    protected function getRelatedSlugs($model, $slug, $id = 0)
    {
        $model = '';
        return $model::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

}