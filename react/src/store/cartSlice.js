import { createSlice, createAsyncThunk } from "@reduxjs/toolkit"
import {DOMAIN} from '../utils/url'
import Cookies from 'js-cookie'

export const updateCartTry = createAsyncThunk('cart/updateCartTry',
    async({ id, quantity }, thunkAPI) => {
        const state = thunkAPI.getState();
        const cart = state.cart.cart
        // console.log('updateCartTry')
        // console.log(cart)
        const url = `${DOMAIN}api/public/cart/update`;

        let products = [];
        for (let key in cart) {
           const item = cart[key];
           products.push({
                id: item.product.id,
                quantity: item.count,
           })
        }

        // console.log(products)

        const body = JSON.stringify({
            cart: products,
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

        let productsDict = {};
        for (let product of data.products || []) {
            productsDict[product.id] = product;
        }

        let _cart = {};
        for (let cart_product of data.cart_products || []) {
            const quantity = cart_product.quantity;
            const id = cart_product.product_id;
            if (quantity && quantity > 0)  {
                _cart[id] = {
                    product: productsDict[id],
                    count: quantity,
                };
            } else {
                delete _cart[id]; // remove useless property
            }
        }
        return {
            cart: _cart,
            id: data.id
        };
    },
)

const cartSlice = createSlice({
    name: 'cart',
    initialState: {
        id: undefined,
        cart: {},
        isCartHidden: true,
    },
    reducers: {
        updateCartProducts(state, action) {
            console.log('[UI] updateCartProducts')
            // just UI
            let data = action.payload;
            let cart = state.cart;
            const { product, count } = data;
            console.log(data)
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
                const data = action.payload;
                state.cart = data.cart;
                state.id = data.id;
            })
    },
});

export const { updateCartProducts, setCartHidden, clearCart } = cartSlice.actions;

export default cartSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore
