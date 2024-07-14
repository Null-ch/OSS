import React from 'react';
import { useGetItemsQuery } from "../../store/query/itemsApi";
import ItemsList from './items/ItemsList';
import './shop.css';

const Shop = () => {
    document.title = 'Продукты'

    const {data = [], isLoading, error} = useGetItemsQuery();
    console.log(data);
    if (error) {
      console.log(`error: ${error}`);
    }
    
    // todo здесь будет другой роут, типа categories with products
    // чтобы получить категории с продуктами и в таком же порядке отобразить их а не через жопу

    let productsMap = new Map();
    for (let product of data?.data?.data || []) {
        const category = product.category
        if (!category || !category.id) { continue; }
        let list = productsMap.get(category) || [];
        list.push(product);
        productsMap.set(category, list);
    }

    let productsList = [];
    productsMap.forEach((products, category) => {
        productsList.push(
            <div key = {category && category.id} className = 'shop-category-products'>
                <h1 className = 's-c-p-title'>{category.title}</h1>
                <ItemsList items = {products}/>
            </div>
        );
    });

    return (
        <div className = 'shop'>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {productsList}
        </div>
    );
};

export default Shop;