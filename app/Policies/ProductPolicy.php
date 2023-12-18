<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create(User $user)
    {
        // Logic to authorize creating a post
        return $user->hasPermissionTo('create-product');
    }

    public function update(User $user, Product $product)
    {
        // Logic to authorize updating a post
        return $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product)
    {
        // Logic to authorize deleting a post
        return $user->id === $product->user_id;
    }
}
