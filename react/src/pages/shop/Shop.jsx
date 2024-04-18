import React from 'react';
import { useGetItemsQuery } from "../../store/query/itemsApi";
import ItemsList from './items/ItemsList';
import './shop.css';

const Shop = () => {
    const {data = [], isLoading, error} = useGetItemsQuery();
<<<<<<< HEAD
    // console.log(data)
=======
  
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
    if (error) {
      console.log(`error: ${error}`);
    }

    return (
        <div className = 'shop'>
            {isLoading ? <h1>Loading...</h1> : ''}
<<<<<<< HEAD
            <ItemsList items = {data.products}/>
=======
            <ItemsList items = {data}/>
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
        </div>
    );
};

export default Shop;