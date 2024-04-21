import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react'
import { DOMAIN } from '../../utils/url'

// RTK query
export const itemsApi = createApi({
    reducerPath: 'itemsApi',
    baseQuery: fetchBaseQuery({baseUrl: DOMAIN}),
    endpoints: (builder) => ({
        getItems: builder.query({
            query: () => '/products',
        })
    })
})

export const { useGetItemsQuery } = itemsApi;