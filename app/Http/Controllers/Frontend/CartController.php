<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart(): Cart
    {
        $sessionKey = $this->getGuestCartKey();

        if (Auth::check()) {
            $userCart = Cart::query()->where('user_id', Auth::id())->first();
            $guestCart = Cart::query()->where('session_key', $sessionKey)->first();

            if ($userCart && $guestCart && $userCart->id !== $guestCart->id) {
                $this->mergeCartItems($guestCart, $userCart);
                $guestCart->delete();
            }

            if (!$userCart && $guestCart) {
                $guestCart->update([
                    'user_id' => Auth::id(),
                ]);

                return $guestCart->fresh();
            }

            return $userCart ?? Cart::query()->create([
                'user_id' => Auth::id(),
                'session_key' => $sessionKey,
            ]);
        }

        return Cart::query()->firstOrCreate(
            ['session_key' => $sessionKey],
            ['user_id' => null]
        );
    }

    private function findProduct($id, $slug): Product
    {
        return Product::query()
            ->where('id', $id)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function index()
    {
        $cart = $this->getCart()->load('items.itemable');

        return view('frontend.cart.index', compact('cart'));
    }

    public function add(Request $request, $id, $slug)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $product = $this->findProduct($id, $slug);
        $cart = $this->getCart();
        $quantity = (int) ($request->quantity ?? 1);

        $cartItem = $cart->items()
            ->where('itemable_id', $product->id)
            ->where('itemable_type', get_class($product))
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => min($cartItem->quantity + $quantity, 10),
            ]);
        } else {
            $cart->storeItem($product, $quantity);
        }

        $cart = $this->getCart()->load('items.itemable');

        $cartCount = $cart->items->sum('quantity');
        $cartSubtotal = $cart->items->sum(function ($item) {
            $itemProduct = $item->itemable;

            if (!$itemProduct) {
                return 0;
            }

            return $itemProduct->getPrice() * $item->quantity;
        });

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng.',
                'product_name' => $product->name,
                'cart_count' => $cartCount,
                'cart_subtotal' => number_format($cartSubtotal, 0, ',', '.') . 'đ',
            ]);
        }

        return back()->with([
            'cart_success' => 'Đã thêm sản phẩm vào giỏ hàng.',
            'cart_product_name' => $product->name,
        ]);
    }

    public function increase(Request $request, $id, $slug)
    {
        $product = $this->findProduct($id, $slug);
        $cart = $this->getCart();
        $cartItem = $this->getCartItem($cart, $product);

        if (!$cartItem) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng.',
                ], 404);
            }

            return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $cartItem->update([
            'quantity' => min($cartItem->quantity + 1, 10),
        ]);

        $cartData = $this->getCartData();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã tăng số lượng.',
                'item_id' => $product->id,
                'quantity' => $cartItem->fresh()->quantity,
                'line_total' => $product->getPrice() * $cartItem->fresh()->quantity,
                'line_total_format' => number_format($product->getPrice() * $cartItem->fresh()->quantity, 0, ',', '.') . 'đ',
                'cart' => $cartData,
            ]);
        }

        return back();
    }

    public function decrease(Request $request, $id, $slug)
    {
        $product = $this->findProduct($id, $slug);
        $cart = $this->getCart();
        $cartItem = $this->getCartItem($cart, $product);

        if (!$cartItem) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng.',
                ], 404);
            }

            return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        if ($cartItem->quantity <= 1) {
            $cartItem->delete();

            $cartData = $this->getCartData();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã xoá sản phẩm khỏi giỏ hàng.',
                    'item_id' => $product->id,
                    'quantity' => 0,
                    'removed' => true,
                    'cart' => $cartData,
                ]);
            }

            return back();
        }

        $cartItem->update([
            'quantity' => $cartItem->quantity - 1,
        ]);

        $cartItem = $cartItem->fresh();
        $cartData = $this->getCartData();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã giảm số lượng.',
                'item_id' => $product->id,
                'quantity' => $cartItem->quantity,
                'line_total' => $product->getPrice() * $cartItem->quantity,
                'line_total_format' => number_format($product->getPrice() * $cartItem->quantity, 0, ',', '.') . 'đ',
                'cart' => $cartData,
            ]);
        }

        return back();
    }

    public function remove(Request $request, $id, $slug)
    {
        $product = $this->findProduct($id, $slug);
        $cart = $this->getCart();
        $cartItem = $this->getCartItem($cart, $product);

        if (!$cartItem) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng.',
                ], 404);
            }

            return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $cartItem->delete();
        $cartData = $this->getCartData();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xoá sản phẩm khỏi giỏ hàng.',
                'item_id' => $product->id,
                'quantity' => 0,
                'removed' => true,
                'cart' => $cartData,
            ]);
        }

        return back()->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng.');
    }

    public function summary()
    {
        $cart = $this->getCart()->load('items.itemable');

        $items = $cart->items
            ->filter(fn ($item) => $item->itemable !== null)
            ->map(function ($item) {
                $product = $item->itemable;
                $price = $product->getPrice();

                return [
                    'id' => $item->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->main_image
                        ? asset('storage/' . $product->main_image)
                        : asset('images/no-image.png'),
                    'quantity' => $item->quantity,
                    'price_format' => number_format($price, 0, ',', '.') . 'đ',
                    'line_total_format' => number_format($price * $item->quantity, 0, ',', '.') . 'đ',
                    'increase_url' => route('user.cart.increase', ['id' => $product->id, 'slug' => $product->slug]),
                    'decrease_url' => route('user.cart.decrease', ['id' => $product->id, 'slug' => $product->slug]),
                    'remove_url' => route('user.cart.remove', ['id' => $product->id, 'slug' => $product->slug]),
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'items' => $items,
            'cart' => $this->getCartData(),
        ]);
    }

    private function getCartData(): array
    {
        $cart = $this->getCart()->load('items.itemable');
        $count = $cart->items->sum('quantity');

        $subtotal = $cart->items->sum(function ($item) {
            $product = $item->itemable;

            if (!$product) {
                return 0;
            }

            return $product->getPrice() * $item->quantity;
        });

        return [
            'count' => $count,
            'subtotal' => $subtotal,
            'subtotal_format' => number_format($subtotal, 0, ',', '.') . 'đ',
            'total' => $subtotal,
            'total_format' => number_format($subtotal, 0, ',', '.') . 'đ',
        ];
    }

    private function getCartItem(Cart $cart, Product $product)
    {
        return $cart->items()
            ->where('itemable_id', $product->id)
            ->where('itemable_type', get_class($product))
            ->first();
    }

    private function getGuestCartKey(): string
    {
        $session = request()->session();
        $sessionKey = $session->get('guest_cart_key');

        if (!$sessionKey) {
            $sessionKey = $session->getId();
            $session->put('guest_cart_key', $sessionKey);
        }

        return $sessionKey;
    }

    private function mergeCartItems(Cart $sourceCart, Cart $targetCart): void
    {
        $sourceCart->loadMissing('items');

        foreach ($sourceCart->items as $sourceItem) {
            $targetItem = $targetCart->items()
                ->where('itemable_id', $sourceItem->itemable_id)
                ->where('itemable_type', $sourceItem->itemable_type)
                ->first();

            if ($targetItem) {
                $targetItem->update([
                    'quantity' => min($targetItem->quantity + $sourceItem->quantity, 10),
                ]);

                $sourceItem->delete();
                continue;
            }

            $sourceItem->update([
                'cart_id' => $targetCart->id,
            ]);
        }
    }
}
