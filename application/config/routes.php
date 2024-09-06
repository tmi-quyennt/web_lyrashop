<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'indexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// HOME
$route['danh-muc/(:any)/(:any)']['GET'] = 'IndexController/category/$1/$2';
$route['thuong-hieu/(:any)/(:any)']['GET'] = 'IndexController/brand/$1/$2';
$route['san-pham/(:any)/(:any)']['GET'] = 'IndexController/product/$1/$2';
$route['gio-hang']['GET'] = 'IndexController/cart';
$route['add-to-cart']['POST'] = 'IndexController/add_to_cart';
$route['update-cart-item']['POST'] = 'IndexController/update_cart_item';
$route['delete-all-cart']['GET'] = 'IndexController/delete_all_cart';
$route['delete-item/(:any)']['GET'] = 'IndexController/delete_item/$1';
$route['dang-nhap']['GET'] = 'IndexController/login';
$route['checkout']['GET'] = 'IndexController/checkout';
$route['confirm-checkout']['POST'] = 'IndexController/confirm_checkout';
$route['online-checkout']['POST'] = 'OnlineCheckOutController/online_checkout';

$route['dang-xuat']['GET'] = 'IndexController/dang_xuat';
$route['thanks']['GET'] = 'IndexController/thanks';
$route['tim-kiem']['GET'] = 'IndexController/tim_kiem';

// LOGIN


$route['login']['GET'] = 'LoginController/index';
$route['login-user']['POST'] = 'LoginController/login';
$route['login-customer']['POST'] = 'IndexController/login_customer';
$route['dang-ky']['POST'] = 'IndexController/dang_ky';

//DASHBOARD
$route['dashboard']['GET'] = 'DashboardController/index';
$route['logout']['GET'] = 'DashboardController/logout';
$route['order/statistics'] = 'OrderController/statistics';

// BRAND
$route['brand/create']['GET'] = 'BrandController/create';
$route['brand/list']['GET'] = 'BrandController/index';
$route['brand/delete/(:any)']['GET'] = 'BrandController/delete/$1';
$route['brand/edit/(:any)']['GET'] = 'BrandController/edit/$1';
$route['brand/update/(:any)']['POST'] = 'BrandController/update/$1';
$route['brand/store']['POST'] = 'BrandController/store';

// CATEGORY
$route['category/create']['GET'] = 'CategoryController/create';
$route['category/list']['GET'] = 'CategoryController/index';
$route['category/delete/(:any)']['GET'] = 'CategoryController/delete/$1';
$route['category/edit/(:any)']['GET'] = 'CategoryController/edit/$1';
$route['category/update/(:any)']['POST'] = 'CategoryController/update/$1';
$route['category/store']['POST'] = 'CategoryController/store';

// PRODUCT
$route['product/create']['GET'] = 'ProductController/create';
$route['product/list']['GET'] = 'ProductController/index';
$route['product/delete/(:any)']['GET'] = 'ProductController/delete/$1';
$route['product/edit/(:any)']['GET'] = 'ProductController/edit/$1';
$route['product/update/(:any)']['POST'] = 'ProductController/update/$1';
$route['product/store']['POST'] = 'ProductController/store';

// ORDER
$route['order/list']['GET'] = 'OrderController/index';
$route['order/process']['POST'] = 'OrderController/process';
$route['order/view/(:any)']['GET'] = 'OrderController/view/$1';
$route['order/delete/(:any)']['GET'] = 'OrderController/delete_order/$1';

// USER
$route['user/create']['GET'] = 'UserController/create';
$route['user/list']['GET'] = 'UserController/index';
$route['user/delete/(:any)']['GET'] = 'UserController/delete/$1';
$route['user/edit/(:any)']['GET'] = 'UserController/edit/$1';
$route['user/update/(:any)']['POST'] = 'UserController/update/$1';
$route['user/store']['POST'] = 'UserController/store';

//api-user
$route['api/user'] = 'api/userController/index';
$route['api/user/adduser'] = 'api/userController/addUser';
$route['api/user/find/(:any)'] = 'api/userController/findUser/$1';
$route['api/user/update/(:any)'] = 'api/userController/updateUser/$1';
$route['api/user/delete/(:any)'] = 'api/userController/deleteUser/$1';

// api customers
$route['api/customers'] = 'api/customersController/index';
$route['api/customers/addcustomers'] = 'api/customersController/addcustomers';
$route['api/customers/find/(:any)'] = 'api/customersController/findcustomers/$1';
$route['api/customers/update/(:any)'] = 'api/customersController/updatecustomers/$1';
$route['api/customers/delete/(:any)'] = 'api/customersController/deletecustomers/$1';

//api brands

$route['api/brands'] = 'api/brandsController/index';
$route['api/brands/addbrands'] = 'api/brandsController/addbrands';
$route['api/brands/find/(:any)'] = 'api/brandsController/findbrands/$1';
$route['api/brands/update/(:any)'] = 'api/brandsController/updatebrands/$1';
$route['api/brands/delete/(:any)'] = 'api/brandsController/deletebrands/$1';

//api category
$route['api/category'] = 'api/categoryController/index';
$route['api/category/addcategory'] = 'api/categoryController/addcategory';
$route['api/category/find/(:any)'] = 'api/categoryController/findcategory/$1';
$route['api/category/update/(:any)'] = 'api/categoryController/updatecategory/$1';
$route['api/category/delete/(:any)'] = 'api/categoryController/deletecategory/$1';

//api product

$route['api/product'] = 'api/productController/index';
$route['api/product/addproduct'] = 'api/productController/addproduct';
$route['api/product/find/(:any)'] = 'api/productController/findproduct/$1';
$route['api/product/update/(:any)'] = 'api/productController/updateproduct/$1';
$route['api/product/delete/(:any)'] = 'api/productController/deleteproduct/$1';