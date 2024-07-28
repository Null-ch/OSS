import { createSlice, createAsyncThunk, createAction } from "@reduxjs/toolkit"
import {DOMAIN} from '../utils/url'
import Cookies from 'js-cookie'

// window.localStorage.clear();
let res = window.localStorage.getItem('oss-cart') || '{}';
var cart = JSON.parse(res) || {};

export const updateCartTry = createAsyncThunk('cart/updateCartTry',
    async(data, thunkAPI) => {
        
        const url = `${DOMAIN}api/public/cart/update`;
        // console.log(data)
        // console.log(url)
        const _res = await fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({
                sessionID: Cookies.get('sessionID'),
                cart: [
                    {
                        id: data.product.id,
                        quantity: data.count,
                    },
                ]
            })
        })

        const res = await _res.json();
        console.log(url);
        console.log(res);
      },
)

export const getCart = createAsyncThunk('cart/getCart', 
    async(data, thunkAPI) => {
        const url = `${DOMAIN}api/public/cart`;
        // console.log(data)
        console.log(url);
        const cookie = 'laravel_session=' + (Cookies.get('sessionID') || '')
        document.cookie = cookie;
        console.log(cookie);
        const _res = await fetch(url, {
            method: 'GET',
            headers: {
                // 'cookie': cookie,
                'credentials': 'include',
                'Content-Type': 'application/json;charset=utf-8'
              },
        });
        const res = await _res.json();
        console.log(res);
      },
)

const cartSlice = createSlice({
    name: 'cart',
    initialState: {
        cart,
        isCartHidden: true,
    },
    reducers: {
        updateCartProducts(state, action) {
            // just UIX
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
            
            window.localStorage.setItem('oss-cart', JSON.stringify(cart));
            state.cart = cart;
            // console.log('ok')
            // todo loader
        },
        setCartHidden(state, action) {
            state.isCartHidden = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(updateCartTry.pending, (state, action) => {
                console.log('updateCartTry.pending');

            })
            .addCase(updateCartTry.fulfilled, (state, action) => {
                console.log('updateCartTry.fulfilled');
                // state.cart = cart;
            })
            .addCase(getCart.pending, (state, action) => {
                console.log('getCart.pending');

            })
            .addCase(getCart.fulfilled, (state, action) => {
                console.log('getCart.fulfilled');
                // state.cart = cart;
            })
    },
});

export const { updateCartProducts, setCartHidden } = cartSlice.actions;

export default cartSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore
