import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react'
import { DOMAIN } from '../../utils/url'

// RTK query
<<<<<<< HEAD
// console.log(DOMAIN)
=======

>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
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