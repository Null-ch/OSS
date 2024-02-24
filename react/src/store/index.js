import { configureStore } from "@reduxjs/toolkit";
import categoryReducer from "./categorySlice";
import { itemsApi } from "./query/itemsApi";

// todo user slice
// todo cart slice

export default configureStore({
    reducer: {
        category: categoryReducer,
        [itemsApi.reducerPath]: itemsApi.reducer,
        // user: userSlice
    },
    // логика которая выполняется во время запуска
    // экшенов до их выполнения:
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(itemsApi.middleware)
});