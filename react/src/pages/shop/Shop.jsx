import React from 'react';
import { useGetCategoriesItemsQuery } from "../../store/query/itemsApi";
import ItemsList from './items/ItemsList';
import './shop.css';

const Shop = () => {
    document.title = 'Продукты'

    const {data = [], isLoading, error} = useGetCategoriesItemsQuery();
    // console.log(data);
    if (error) {
      console.log(`error: ${error}`);
    }
    
    const categories = data?.data?.data || [];

    let productsList =  categories.map((category) => {
        return <div key = {category && category.id} className = 'shop-category-products'>
            <h1 className = 's-c-p-title'>{category.title}</h1>
            <ItemsList items = {category.products || []}/>
        </div>
    })

    return (
        <div className = 'shop'>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {productsList}
        </div>
    );
};

export default Shop;