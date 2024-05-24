# 購物車的架構
carts 購物車
    id
    created_at, updated_at
cart_items 購物車內的東西(關聯表)
    id
    cart_id(foreignId)
    product_id(foreignId)
    created_at, updated_at
products 產品
    id
    title(string)
    content(string)
    price(integer)
    quantity(integer)
    created_at, updated_at
## 關聯(ORM)
cart -> cartItem 多對一
product -> cartItem 多對一(一個產品，可以不同購物車的商品)

# migration 命名慣例
添加表  
php artisan make:migration create_products (複數)
添加一個欄位 
php artisan make:migration add_quantity_to_cart_item

# 指令
## Controller
php artisan make:controller CartController

## Model
想使用 Cart::find();

前提得先建立與使用model ex;
php artisan make:model CartModel
use App\Models\cart;

# CsrfToken
VerifyCsrfToken.php
protected $except = [
    '*'
];

## 建立mail
php artisan make:mail FirstMail
建立後加上 build function
{
    return $this->from('from@example.com')->view('mail.index');
}