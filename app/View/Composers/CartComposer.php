<?php


namespace App\View\Composers;

use Illuminate\View\View;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $cart_count;
    protected $cart;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->cart = Cart::getContent()->toArray();
        $this->cart_count = Cart::getContent()->count();
        // Dependencies are automatically resolved by the service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('cart_count', $this->cart_count);
        $view->with('cart', $this->cart);
    }
}

?>
