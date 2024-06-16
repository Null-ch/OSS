import {createSlice} from "@reduxjs/toolkit"
import {DOMAIN} from '../utils/url'
import {STATUS} from '../utils/status'

const catSlice = createSlice({
    name: 'category',
    initialState: {
        data: [],
        status: STATUS.IDLE,
        catProducts: [],
        catProductsStatus: STATUS.IDLE,
        catProduct: [],
        catProductStatus: STATUS.IDLE,
    },
    reducers: {
        setCats(state, action){
            state.data = action.payload;
        },
        setStatus(state, action){
            state.status = action.payload;
        },
        setCatProducts(state, action){
            state.catProducts.push(action.payload);
        },
        setCatProductsStatus(state, action){
            state.catProductsStatus = action.payload;
        },
        setCatProduct(state, action){
            state.catProduct = action.payload;
        },
        setCatProductStatus(state, action){
            state.catProductStatus = action.payload;
        }
    }
})

export const {setCats, setStatus, setCatProducts, setCatProductsStatus,
    setCatProduct, setCatProductStatus} = catSlice.actions;

export default catSlice.reducer; // формируется автоматически из набора reducers в срезе
// эта сущность подключается в store через configureStore

export const fetchCategories = () => {
    return async function fetchCatThunk(dispatch) {
        dispatch(setStatus(STATUS.LOADING));

        try {
            const url = `${DOMAIN}api/public/categories`;
            // console.log(url)
            const res = await fetch(url)

            const data = await res.json();
            // console.log(data)
        
            dispatch(setCats(data.categories.slice(0, 5)));
            dispatch(setStatus(STATUS.IDLE))
        } catch(err){
            dispatch(setStatus(STATUS.ERROR));
        }
    }
}

export const fetchProductsByCat = (catId, type) => {
    return async function fetchCatProductThunk(dispatch){ // thunk - либа для создания асинхр. action
        // (которые синхр. по умолчанию)
        if (type === 'all') dispatch(setCatProducts(STATUS.LOADING));
        if (type === 'single') dispatch(setCatProductStatus(STATUS.LOADDING));
        
        try {
            const url = `${DOMAIN}api/public/categories/${catId}/products`;
            const res = await fetch(url);
            const data = await res.json();
            if (type === 'all'){
                dispatch(setCatProducts(data.slice(0, 10)));
                dispatch(setCatProductsStatus(STATUS.IDLE));
            }

            if (type === 'single'){
                dispatch(setCatProduct(data.slice(0, 20))); // ???
                dispatch(setCatProductStatus(STATUS.IDLE));
            }

        } catch(err) {
            if (type === 'all') dispatch(setCatProductsStatus(STATUS.ERROR));
            if (type === 'single') dispatch(setCatProductStatus(STATUS.ERROR));
        }
    }
}





