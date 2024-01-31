import { CART, SHOP, HOME, ITEM } from './util/constants'
import Home from './pages/Home'
import Cart from './pages/Cart'
import Shop from './pages/Shop'
import Item from './pages/Item'

export const authRoutes = [

]

export const publicRoutes = [
    {
        path: HOME,
        component: <Home/>,
    },
    {
        path: CART,
        component: <Cart/>,
    },
    {
        path: SHOP,
        component: <Shop/>,
    },
    {
        path: ITEM + '/:id',
        component: <Item/>,
    },
]