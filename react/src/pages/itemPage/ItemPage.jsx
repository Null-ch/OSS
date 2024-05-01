import React from 'react';
import { useGetItemQuery } from '../../store/query/itemsApi';
import './itemPage.css'
import {DOMAIN} from '../../utils/url'

const ItemPage = ({}) => {
    // общее хранилище со всеми продуктами, либо сбор всех и кеширование
    const {data = [], isLoading} = useGetItemQuery(1);

    console.log(data);

    const product = data.product

    return (
        <div>
            {isLoading ? <h1>Loading...</h1> : ''}
            {product &&
                <article className = 'item-page'>
                    <img className = 'item-page-preview' src = {`${DOMAIN}${product.preview_image}`}/>
                    <div className = 'item-page-info'>
                        <div className = 'item-page-title-container'>
                            <span className = 'item-page-brand'>SAMPLE-TEXT</span>
                            <h1 className = 'item-page-title' title = 'Название продукта'>{product.title}</h1>
                        </div>
                        <div className = 'item-page-price-container'>
                            <span className = 'item-page-price' title = 'Цена за 1шт.'>{product.price}</span>
                            <span className = 'item-page-price-currency'> ₽</span>
                        </div>
                        {/* кнопки */}
                        <p className = 'item-page-description'>{product.description}</p>
                    </div>
                </article>
            }
        </div>
    );
};

export default ItemPage;