import { configureStore } from "@reduxjs/toolkit";
import categoryReducer from "./categorySlice";
import { itemsApi } from "./query/itemsApi";
import { categoriesApi } from "./query/categoriesApi";
import modalReducer from './modalSlice'

// todo user slice
// todo cart slice

export default configureStore({
    reducer: {
        category: categoryReducer,
        modal: modalReducer,
        // reducer создаётся RTK Query автоматически, он содержит в т.ч эндпоинты
        [itemsApi.reducerPath]: itemsApi.reducer, // 'itemsApi'
        [categoriesApi.reducerPath]: categoriesApi.reducer, // 'categoriesApi'
        // user: userSlice
    },

    // вообще не рекомендуется в хранить несериализуемые данные (н-р компоненты)
    // в слайсах, но для модального окна можно сделать исключение, т.к он может содержать
    // разное наполнение, а его экземпляр всегда один - в App.jsx

    // логика которая выполняется во время запуска
    // экшенов до их выполнения:
    middleware: (getDefaultMiddleware) => getDefaultMiddleware(
        {
            serializableCheck: {
                // Ignore these action types
                ignoredActions: ['modal/setContent'],

                // Ignore these field paths in all actions
                // ignoredActionPaths: ['meta.arg', 'payload.timestamp'],
                
                // Ignore these paths in the state
                ignoredPaths: ['modal.content'],
              },
        }
    )
    // дополнительно добавляем свои миддлвейры в из наших Api
    .concat(itemsApi.middleware) 
    .concat(categoriesApi.middleware)
});