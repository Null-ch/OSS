import { createSlice, createAsyncThunk } from "@reduxjs/toolkit"
import { DOMAIN } from '../utils/url'
import Cookies from 'js-cookie'

export const createOrder = createAsyncThunk('order/createOrder',
    async(data, thunkAPI) => {
        console.log(data)
        const url = `${DOMAIN}api/public/order/create`;
        console.log(url);

        const body = JSON.stringify(data)

        // todo lib
        const _res = await fetch(url, {
            method: 'POST',
            headers: {
                'Session-Id' : Cookies.get('sessionID'),
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: body,
        })

        const res = await _res.json();
        console.log(res);
    },
)

export const cancelOrder = createAsyncThunk('order/cancelOrder',
    async(id, thunkAPI) => {
        const state = thunkAPI.getState();
        const cart = state.cart.cart
        console.log(id)
        const url = `${DOMAIN}api/public/order/cancel/${id}`;

        // todo test

        // todo lib
        const _res = await fetch(url, {
            method: 'POST',
            headers: {
                'Session-Id' : Cookies.get('sessionID'),
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({}),
        })

        const res = await _res.json();
        console.log(url);
        console.log(res);
    },
)

export const getOrders = createAsyncThunk('order/getOrders', 
    async(_, thunkAPI) => {
        // const url = `${DOMAIN}api/public/cart`;
        // const _res = await fetch(url, {
        //     method: 'GET',
        //     headers: {
        //         'Session-Id' : Cookies.get('sessionID'),
        //         'Content-Type': 'application/json;charset=utf-8'
        //       },
        // });
        // const res = await _res.json();
        // const data = res.data || {};

        // return _cart;
    },
)

const orderSlice = createSlice({
    name: 'order',
    initialState: {
        orders: {},
    },
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(createOrder.pending, (state, action) => {
                // console.log('updateCartTry.pending');
            })
            .addCase(createOrder.fulfilled, (state, action) => {
                // console.log('updateCartTry.fulfilled');
                // state.cart = cart;
            })
            .addCase(cancelOrder.pending, (state, action) => {
                // console.log('getCart.pending');
            })
            .addCase(cancelOrder.fulfilled, (state, action) => {
                state.order = action.payload;
            })
    },
});

export default orderSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore
