import { React } from 'react';
import {useParams} from 'react-router-dom'
import { useGetCategoryProductsQuery } from '../../store/query/categoriesApi';
import ItemsList from '../shop/items/ItemsList';
import './categoryPage.css'

const CategoryPage = () => {
    const { id } = useParams(); // Object с полями перечисленными в этом эндпоинте

    const {data = [], isLoading} = useGetCategoryProductsQuery(id);
    // console.log(data);
    const products = data.products || []

    // todo страница на случай если продуктов в категории нет

    return (
        <div className = 'category-page'>
            <div className = 'category-page-info'>

            </div>
            <ItemsList items = {products}/>
            <div className = 'category-page-products'>

            </div>
        </div>
    );
};

export default CategoryPage;