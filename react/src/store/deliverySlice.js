import { createSlice, createAsyncThunk } from "@reduxjs/toolkit"
import { DOMAIN } from '../utils/url'
import Cookies from 'js-cookie'

export const getDeliveries = createAsyncThunk('delivery/getDelivery', 
    async(_, thunkAPI) => {
        const url = `${DOMAIN}api/public/delivery`;
        const _res = await fetch(url, {
            method: 'GET',
            headers: {
                'Session-Id' : Cookies.get('sessionID'),
                'Content-Type': 'application/json;charset=utf-8'
              },
        });
        const res = await _res.json();
        const data = res.data || {};
        // console.log(data.data);

        return data.data;
    },
)

const deliverySlice = createSlice({
    name: 'delivery',
    initialState: {
        list: [],
    },
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(getDeliveries.pending, (state, action) => {
                // console.log('getDeliveries.pending');
            })
            .addCase(getDeliveries.fulfilled, (state, action) => {
                state.list = action.payload;
            })
    },
});

export default deliverySlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore
