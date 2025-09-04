<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait Hashidable
{
    /**
     * Encode automatiquement l'ID quand Laravel génère une URL
     */
    public function getRouteKey()
    {
        return Hashids::encode($this->getKey());
    }

    /**
     * Décode automatiquement le hash en ID quand Laravel résout une route
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $id = Hashids::decode($value)[0] ?? null;
        return $this->where($field ?? $this->getRouteKeyName(), $id)->firstOrFail();
    }
}
