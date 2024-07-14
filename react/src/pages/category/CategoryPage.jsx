import { React } from 'react';
import {useParams} from 'react-router-dom'
import { useGetCategoryProductsQuery } from '../../store/query/categoriesApi';
import ItemsList from '../shop/items/ItemsList';
import './categoryPage.css'

const CategoryPage = () => {
    const { id } = useParams(); // Object с полями перечисленными в этом эндпоинте

    const {data = [], isLoading} = useGetCategoryProductsQuery(id);
    console.log(data);
    const category = data.category;
    const products = category?.products || []

    // todo страница на случай если продуктов в категории нет

    const product = products[0] || {};
    // const category = product.category;

    return (
        <div className = 'category-page'>
            {
                category &&
                <div className = 'category-page-info'>
                    <h1>{category.title}</h1>
                </div>
            }
            <ItemsList items = {products}/>
        </div>
    );
};

export default CategoryPage;