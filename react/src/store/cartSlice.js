import { createSlice, createAsyncThunk, createAction } from "@reduxjs/toolkit"
import {DOMAIN} from '../utils/url'
import Cookies from 'js-cookie'

// window.localStorage.clear();
// let res = window.localStorage.getItem('oss-cart') || '{}';
// var cart = {};

export const updateCartTry = createAsyncThunk('cart/updateCartTry',
    async({id, quantity}, _) => {
        console.log('updateCartTry')
        const url = `${DOMAIN}api/public/cart/update`;
        const body = JSON.stringify({
            cart: [
                {
                    id,
                    quantity,
                    // id: data.product.id.toString(),
                },
            ]
        })

        const _res = await fetch(url, {
            method: 'POST',
            headers: {
                'Session-Id' : Cookies.get('sessionID'),
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: body,
        })

        const res = await _res.json();
        console.log(url);
        console.log(res);
      },
)

export const getCart = createAsyncThunk('cart/getCart', 
    async(_, thunkAPI) => {
        const url = `${DOMAIN}api/public/cart`;
        const _res = await fetch(url, {
            method: 'GET',
            headers: {
                'Session-Id' : Cookies.get('sessionID'),
                'Content-Type': 'application/json;charset=utf-8'
              },
        });
        const res = await _res.json();
        const data = res.data || {};

        Cookies.set('cartID', data.id)
        const products = data.products || [];

        let _cart = {};
        for (let product of products) {
            const quantity = product.quantity;
            if (quantity && quantity > 0)  {
                _cart[product.id] = {
                    product: product,
                    count: quantity,
                };
            } else {
                delete _cart[product.id]; // remove useless property
            }
        }

        return _cart;
    },
)

const cartSlice = createSlice({
    name: 'cart',
    initialState: {
        cart: {},
        isCartHidden: true,
    },
    reducers: {
        updateCartProducts(state, action) {
            console.log('[UI] updateCartProducts')
            // just UI
            let data = action.payload;
            // console.log(data);
            var cart = JSON.parse(window.localStorage.getItem('oss-cart') || '{}') || {};

            const {product, count} = data;
            if (count && count > 0)  {
                cart[product.id] = {
                    product: data.product,
                    count: data.count,
                };
            } else {
                delete cart[product.id]; // remove useless property
            }
            
            state.cart = cart;
            // todo loader
        },
        clearCart(state, action) {
            const id = Cookies.get('cartID')
            console.log('clearCart, id: ' + (id || '[no id found, abort]'));
            if (!id) return;

            const url = `${DOMAIN}api/public/cart/clear/${id}`;
            console.log(url);

            const _res = fetch(url, {
                method: 'POST',
                headers: {
                    'Session-Id' : Cookies.get('sessionID'),
                    'Content-Type': 'application/json;charset=utf-8'
                },
            })

            state.cart = {};
        },
        setCartHidden(state, action) {
            state.isCartHidden = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(updateCartTry.pending, (state, action) => {
                // console.log('updateCartTry.pending');
            })
            .addCase(updateCartTry.fulfilled, (state, action) => {
                // console.log('updateCartTry.fulfilled');
                // state.cart = cart;
            })
            .addCase(getCart.pending, (state, action) => {
                // console.log('getCart.pending');
            })
            .addCase(getCart.fulfilled, (state, action) => {
                state.cart = action.payload;
            })
    },
});

export const { updateCartProducts, setCartHidden, clearCart } = cartSlice.actions;

export default cartSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore
