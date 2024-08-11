import { CART, PRODUCTS, PRODUCTS_CATEGORY, HOME, ABOUT, CREATE_ORDER } from './utils/constants'
// import Home from './pages/home/Home'
// import Cart from './pages/Cart'
// import Shop from './pages/shop/Shop'
// import Item from './pages/shop/items/Item'
// import About from './pages/About'
import { lazy } from 'react'

// lazy точно нужен?
const Home = lazy(() => import('./pages/home/Home'))
const Shop = lazy(() => import('./pages/shop/Shop'))
const ItemPage = lazy(() => import('./pages/itemPage/ItemPage'))
const About = lazy(() => import('./pages/about/About'))
const CategoryPage = lazy(() => import('./pages/category/CategoryPage'))
const CreateOrder = lazy(() => import('./pages/order/CreateOrder'))

const home = {
    path: HOME,
    component: <Home/>,
    title: 'Главная',
    mobileHidden: true,
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
    title: 'О нас',
    mobileHidden: true,
}

const createOrder = {
    path: CREATE_ORDER,
    component: <CreateOrder/>,
    title: 'Оформление заказа'
}

export const publicRoutes = [
    home,
    products,
    // item,
    itemPage,
    categoriesProducts,
    about,
    createOrder,
]

export const nav = [
    home,
    products,
    about,
]