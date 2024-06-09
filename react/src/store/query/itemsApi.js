import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react'
import { DOMAIN } from '../../utils/url'

// RTK query
export const itemsApi = createApi({
    reducerPath: 'itemsApi',
    baseQuery: fetchBaseQuery({baseUrl: DOMAIN + 'api'}),
    endpoints: (builder) => ({
        getItems: builder.query({
            query: () => '/products',
        }),
        getItem: builder.query({
            query: (id) => ({
                url: `/products/show/${id}`,
                // params: {
                    // id: id
                // }
            })
        }),
    })
})

export const { useGetItemsQuery, useGetItemQuery } = itemsApi;