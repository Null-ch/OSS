import { CART, PRODUCTS, PRODUCTS_CATEGORY, HOME, ABOUT, LOGIN, LOGOUT } from './utils/constants'
// import Home from './pages/home/Home'
// import Cart from './pages/Cart'
// import Shop from './pages/shop/Shop'
// import Item from './pages/shop/items/Item'
// import About from './pages/About'
import { lazy } from 'react'

// lazy точно нужен?
const Home = lazy(() => import('./pages/home/Home'))
const Cart = lazy(() => import('./pages/Cart'))
const Shop = lazy(() => import('./pages/shop/Shop'))
const ItemPage = lazy(() => import('./pages/itemPage/ItemPage'))
const About = lazy(() => import('./pages/About'))
const CategoryPage = lazy(() => import('./pages/category/CategoryPage'))

const home = {
    path: HOME,
    component: <Home/>,
    title: 'Главная'
}

const cart = {
    path: CART,
    component: <Cart/>,
}

const products = {
    path: PRODUCTS,
    component: <Shop/>,
    title: 'Продукты',
    listEntities: 'categories',
    list: [
        {
            path: '/products',
            title: 'Все'
        },
    ],
}

const categoriesProducts = {
    path: PRODUCTS_CATEGORY + '/:id',
    component: <CategoryPage/>,
}

const itemPage = {
    path: PRODUCTS + '/:id',
    component: <ItemPage/>,
}

const about = {
    path: ABOUT,
    component: <About/>,
    title: 'О нас'
}

const login = {
    path: LOGIN,
}

const logout = {
    path: LOGOUT,
}

export const publicRoutes = [
    home,
    cart,
    products,
    // item,
    itemPage,
    categoriesProducts,
    about,
    login,
    logout
]

export const nav = [
    home,
    products,
    about,
]