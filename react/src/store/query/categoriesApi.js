import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react'
import { DOMAIN } from '../../utils/url'

// RTK query
export const categoriesApi = createApi({
    reducerPath: 'categoriesApi', // поле стора в котором будут храниться данные
    baseQuery: fetchBaseQuery({baseUrl: DOMAIN + '/api'}), // может дополнительно принимать заголовки
    endpoints: (builder) => ({ // builder (build) - специальный объект с методами
        getCategories: builder.query({ // .query - метод получения данных из билдера
            // объект с описания того, с чем будем работать
            query: () => '/categories',
        }),
        getCategoryProducts: builder.query({ // .query - метод получения данных из билдера
            // объект с описания того, с чем будем работать
            query: (id) => ({
                url: `/categories/${id}/products`,
            })
        }),
    })
})

// экспорт кастомных хуков для получения данных:
export const { useGetCategoriesQuery, useGetCategoryProductsQuery } = categoriesApi;  // "use..." = хук, "...query" = query-запрос