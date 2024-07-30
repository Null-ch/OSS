import {React, useState} from 'react';
import { useGetItemQuery } from '../../store/query/itemsApi';
import './itemPage.css'
import {DOMAIN} from '../../utils/url'
import Counter from '../../components/counter/Counter';
import Button from '../../components/buttons/Button';
// import NotFound from '../util/NotFound';
import {useParams, Link} from 'react-router-dom'
import Price from '../../components/util/Price';
import { BRAND } from '../../utils/constants';
import { updateCartProducts, updateCartTry } from '../../store/cartSlice';
import { useSelector, useDispatch } from 'react-redux';
import debounce from './../../lib/utils'

// window.localStorage.clear();

const ItemPage = () => {
    // общее хранилище со всеми продуктами, либо сбор всех и кеширование
    const { id } = useParams(); // Object с полями перечисленными в этом эндпоинте

    const {data = [], isLoading} = useGetItemQuery(id);
    const product = data.data;
    // console.log(product);
    document.title = product?.title ? BRAND + ' ' + product.title : BRAND;

    let quantity = product?.quantity || 0;
    let count = 0;
    const items = useSelector(state => state.cart.cart);
    if (items && product) {
        let p = items[product.id] || {};
        count = p.count || count;
    }

    const dispatch = useDispatch();

    const updateCart = (v) => dispatch(updateCartProducts(v));

    function updateCount(count) {
        updateCart({ count, product }); // visual
        
        debounce(() => {
            dispatch(updateCartTry({ count, product })); // request
        }, 1000, 'updateCartTry')
    }

    // todo test
    if (count > quantity) {
        updateCount(quantity);
    }

    function onIncrement(incr) {
        updateCount(Math.max(0, Math.min(Number(count) + incr, quantity)));
    }

    const isNoneSelected = count < 1;
    const capped = count === quantity;

    const category = product?.category;
    const to = category && '/products/category/' + category.id;

    return (
        <div>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {product &&
                <article className = 'item-page'>
                    <div className = 'i-p-preview-container'> 
                        <img className = 'i-p-preview' src = {`${DOMAIN}${product?.preview_image}`}/>
                    </div>
                
                    <div className = 'i-p-info-container'>
                        <div className = 'i-p-info'>
                            <div className = 'item-page-title-container'>
                                <span className = 'item-page-brand'>SAMPLE-TEXT</span>
                                <h1 className = 'item-page-title' title = 'Название продукта'>{product.title}</h1>
                                {
                                    category &&
                                    <Link to = {to} title = 'Категория продукта' className = 'i-p-category-link'>{category.title}</Link>
                                }
                            </div>
                            <Price className = 'i-p-price' title = 'Цена за 1шт.' price = { product.price }/>
                            <div className = 'item-page-shipment-container'>
                                <a className = 'item-page-shipment-link' href = '#'>Доставка</a>
                                <span className = 'item-page-shipment-info'>рассчитывается отдельно</span>
                            </div>
                            <div className = 'i-p-counter-data'>
                                <span className = 'i-p-counter-info'>В корзине:</span>
                                <div className = 'item-page-counter-container'>
                                    <Counter
                                        value = {count}
                                        onIncrement = {onIncrement}
                                        onChangeInput = {updateCount}
                                        disableDecr = {isNoneSelected}
                                        disableIncr = {capped}
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
                            </div>
                            {/* <div className = 'item-page-action-buttons-container'>
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
                            </div> */}
                            <p className = 'item-page-description'>{product.description}</p>
                        </div>
                    </div>
                </article>
            // :
            // <NotFound/>
            }
        </div>
    );
};

export default ItemPage;