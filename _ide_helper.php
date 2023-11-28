<?php

namespace Illuminate\Support {
    /**
     * @method Fluent first()
     * @method Fluent after($column)
     * @method Fluent change()
     * @method Fluent nullable()
     * @method Fluent unsigned()
     * @method Fluent unique()
     * @method Fluent index()
     * @method Fluent primary()
     * @method Fluent default($value)
     * @method Fluent onUpdate($value)
     * @method Fluent onDelete($value)
     * @method Fluent references($value)
     * @method Fluent on($value)
     */
    class Fluent
    {
    }
}

namespace Illuminate\Database\Eloquent {
    /**
     * @method static Collection|static find($id)
     * @method static static|Builder where($column, $operate = null, $condition = null)
     * @method static Collection|static create($array)
     * @method static Collection|static firstOrCreate(array $fetch, array $value = [])
     * @method static Collection|static updateOrCreate(array $fetch, array $value = [])
     */
    class Model
    {
    }
}

namespace Illuminate\Support\Facades {
    /**
     * @method static string|int get($key)
     * @method static void set($key, $value)
     * @method static void publish($channel, $value)
     */
    class Redis
    {
    }

    /**
     * @method static void forceScheme($protocol)
     */
    class URL{}
}
