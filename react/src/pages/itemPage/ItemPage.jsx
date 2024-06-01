import {React, useState} from 'react';
import { useGetItemQuery } from '../../store/query/itemsApi';
import './itemPage.css'
import {DOMAIN} from '../../utils/url'
import Counter from '../../components/counter/Counter';
import Button from '../../components/buttons/Button';
// import NotFound from '../util/NotFound';
import {useParams} from 'react-router-dom'
import Price from '../../components/util/Price';
import { BRAND } from '../../utils/constants';
import { updateCartProducts } from '../../store/cartSlice';
import { useSelector, useDispatch } from 'react-redux';

// window.localStorage.clear();

const ItemPage = () => {
    // общее хранилище со всеми продуктами, либо сбор всех и кеширование
    const { id } = useParams(); // Object с полями перечисленными в этом эндпоинте

    const {data = [], isLoading} = useGetItemQuery(id);

    const product = data.product;
    document.title = product?.title ? BRAND + ' ' + product.title : BRAND;

    let count = 0;
    const items = useSelector(state => state.cart.cart);
    if (items && product) {
        let p = items[product.id] || {};
        count = p.count || count;
    }

    const dispatch = useDispatch();
    const updateCart = (v) => dispatch(updateCartProducts(v));

    function updateCount(count) {
        updateCart({ count, product });
    }

    function onIncrement(incr) {
        updateCount(Math.max(0, Math.min(Number(count) + incr)));
    }

    const isNoneSelected = count < 1;

    return (
        <div>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {product &&
                <article className = 'item-page'>
                    <img className = 'item-page-preview' src = {`${DOMAIN}${product?.preview_image}`}/>
                    <div className = 'item-page-info'>
                        <div className = 'item-page-title-container'>
                            <span className = 'item-page-brand'>SAMPLE-TEXT</span>
                            <h1 className = 'item-page-title' title = 'Название продукта'>{product.title}</h1>
                        </div>
                        <Price className = 'i-p-price' title = 'Цена за 1шт.' price = { product.price }/>
                        <div className = 'item-page-shipment-container'>
                            <a className = 'item-page-shipment-link' href = '#'>Доставка</a>
                            <span className = 'item-page-shipment-info'>рассчитывается отдельно</span>
                        </div>
                        <div className = 'item-page-counter-container'>
                            <Counter
                                value = {count}
                                onIncrement = {onIncrement}
                                onChangeInput = {updateCount}
                                disableDecr = {isNoneSelected}
                                className = 'i-p-counter '
                                btnClassName = 'i-p-counter-button'
                                btnDisabledClassName = 'i-p-counter-button-disabled'
                            />
                            {
                                !isNoneSelected &&
                                <Price
                                    className = 'i-p-price-total'
                                    title = 'Сумма'
                                    price = { '= ' + String(count * product.price)}
                                />
                            }
                        </div>
                        <div className = 'item-page-action-buttons-container'>
                            <Button
                            
                                disabled = {isNoneSelected}
                                className = {isNoneSelected ? 'item-page-button-disabled' : 'item-page-button'}
                                title = {isNoneSelected ? 'Нечего добавить' : 'Добавить в корзину'}
                                text = 'В корзину'
                            />
                            <Button
                                disabled = {isNoneSelected}
                                className = {isNoneSelected ? 'item-page-button-disabled' : 'item-page-button'}
                                title = {isNoneSelected ? 'Нечего заказать' : 'Быстрый заказ'}
                                text = 'Заказать'
                            />
                        </div>
                        <p className = 'item-page-description'>{product.description}</p>
                    </div>
                </article>
            // :
            // <NotFound/>
            }
        </div>
    );
};

export default ItemPage;