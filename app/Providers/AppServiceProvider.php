<?php

namespace App\Providers;

use App\Services\CategoryService;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer([
            'layouts.frontend.header-nav',
            'layouts.frontend.nav-mobile',
            'layouts.frontend.cart',
        ], function ($view) {
            $categoryService = app(CategoryService::class);

            $view->with('menuCategories', $categoryService->getMenuCategories());
            $view->with($this->resolveFrontendCartViewData());
        });
    }

    private function resolveFrontendCartViewData(): array
    {
        $sessionKey = null;

        if (request()->hasSession()) {
            $sessionKey = session('guest_cart_key');

            if (!$sessionKey) {
                $sessionKey = request()->session()->getId();
                request()->session()->put('guest_cart_key', $sessionKey);
            }
        }

        $cart = Cart::query()
            ->with('items.itemable')
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            }, function ($query) use ($sessionKey) {
                $query->where('session_key', $sessionKey);
            })
            ->first();

        $cartItems = $cart
            ? $cart->items->filter(fn ($item) => $item->itemable !== null)->values()
            : collect();

        $cartCount = $cartItems->sum('quantity');
        $cartSubtotal = $cartItems->sum(function ($item) {
            return $item->itemable->getPrice() * $item->quantity;
        });

        return [
            'headerCart' => $cart,
            'cartItems' => $cartItems,
            'cartCount' => $cartCount,
            'cartSubtotal' => $cartSubtotal,
        ];
    }
}
