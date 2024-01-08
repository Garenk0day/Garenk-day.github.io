<?php

namespace Modules\Shop\Repositories\Front\Interfaces;

use App\Models\User;
use Modules\Shop\app\Models\Cart;
use Modules\Shop\app\Models\CartItem;
use Modules\Shop\app\Models\Product;

interface CartRepositoryInterface
{
    public function findByUser(User $user): Cart;
    public function addItem(Product $product, $qty): CartItem;
    public function removeItem($id): bool;
    public function updateQty($items = []): void;
}