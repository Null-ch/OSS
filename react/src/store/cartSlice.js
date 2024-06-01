import {createSlice} from "@reduxjs/toolkit"

// window.localStorage.clear();
let res = window.localStorage.getItem('oss-cart') || '{}';
var cart = JSON.parse(res) || {};

const cartSlice = createSlice({
    name: 'category',
    initialState: { cart },
    reducers: {
        updateCartProducts(state, action) {
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
        },
    }
});

export const { updateCartProducts } = cartSlice.actions;

export default cartSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore