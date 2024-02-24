import React from 'react';
import { useGetItemsQuery } from "../../store/query/itemsApi";
import ItemsList from './items/ItemsList';
import './shop.css';

const Shop = () => {
    const {data = [], isLoading, error} = useGetItemsQuery();
    // console.log('data:')
    // console.log(data)
  
    if (error) {
      console.log(`error: ${error}`);
    }

    return (
        <div className = 'shop'>
            {isLoading ? <h1>Loading...</h1> : ''}
            <ItemsList items = {data}/>
        </div>
    );
};

export default Shop;