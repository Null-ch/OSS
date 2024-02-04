import { CART, SHOP, HOME, ITEM, ABOUT } from './util/constants'
import Home from './pages/Home'
import Cart from './pages/Cart'
import Shop from './pages/Shop'
import Item from './pages/Item'
import About from './pages/About'

export const routes = [
    {
        path: HOME,
        component: <Home/>,
        title: 'Главная'
    },
    {
        path: CART,
        component: <Cart/>,
    },
    {
        path: SHOP,
        component: <Shop/>,
        title: 'Магазин'
    },
    {
        path: ITEM + '/:id',
        component: <Item/>,
    },
    {
        path: ABOUT,
        component: <About/>,
        title: 'О нас'
    },
]