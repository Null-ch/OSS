import { CART, SHOP, HOME, ITEM, ABOUT, LOGIN, LOGOUT } from './util/constants'
import Home from './pages/home/Home'
import Cart from './pages/Cart'
import Shop from './pages/Shop'
import Item from './pages/Item'
import About from './pages/About'

const home = {
    path: HOME,
    component: <Home/>,
    title: 'Главная'
}

const cart = {
    path: CART,
    component: <Cart/>,
}

const shop = {
    path: SHOP,
    component: <Shop/>,
    title: 'Магазин'
}

const item = {
    path: ITEM + '/:id',
    component: <Item/>,
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
    shop,
    item,
    about,
    login,
    logout
]

export const nav = [
    home,
    shop,
    about,
]