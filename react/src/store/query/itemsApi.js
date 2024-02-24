import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react'
import { BASE_URL_FAKE } from '../../utils/url'

export const itemsApi = createApi({
    reducerPath: 'itemsApi',
    baseQuery: fetchBaseQuery({baseUrl: BASE_URL_FAKE}),
    endpoints: (builder) => ({
        getItems: builder.query({
            query: () => '/products',
        })
    })
})

export const { useGetItemsQuery } = itemsApi;