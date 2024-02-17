import { configureStore } from "@reduxjs/toolkit";
import categoryReducer from "./categorySlice";

// todo user slice
// todo cart slice

export default configureStore({
    reducer: {
        category: categoryReducer,
        // user: userSlice
    }
});