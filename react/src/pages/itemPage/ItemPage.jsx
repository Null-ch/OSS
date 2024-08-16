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

    const { data = [], isLoading } = useGetItemQuery(id);
    const thisProduct = data.data || {};

    document.title = thisProduct?.title ? BRAND + ' ' + thisProduct.title : BRAND;

    let otherProductsCount = 0;
    let selected = 0;
    const cart_products = useSelector(state => state.cart.cart);

    for (let key in cart_products) {
        const cart_product = cart_products[key];
        const product = cart_product.product;
        if (product.id == thisProduct.id) continue;
        otherProductsCount += cart_product.count;
    }
    if (cart_products && thisProduct) {
        let p = cart_products[thisProduct.id] || {};
        selected = p.count || selected;
    }

    const total = (thisProduct?.quantity || 0) + selected;

    const dispatch = useDispatch();
    const updateCart = (v) => dispatch(updateCartProducts(v));

    function updateCount(count) {
        updateCart({ count, product: thisProduct }); // visual
        
        debounce(() => {
            dispatch(updateCartTry({ id: thisProduct.id, quantity: count })); // request
        }, 1000, 'updateCartTry')
    }

    // todo test
    if (selected > total) {
        updateCount(total);
    }

    function onIncrement(incr) {
        updateCount(Math.max(0, Math.min(Number(selected) + incr, total)));
    }

    const isNoneSelected = selected < 1;
    const capped = selected === total;

    const category = thisProduct?.category;
    const to = category && '/products/category/' + category.id;

    return (
        <div>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {thisProduct &&
                <article className = 'item-page'>
                    <div className = 'i-p-preview-container'> 
                        <img className = 'i-p-preview' src = {`${DOMAIN}${thisProduct?.preview_image}`}/>
                    </div>
                
                    <div className = 'i-p-info-container'>
                        <div className = 'i-p-info'>
                            <div className = 'item-page-title-container'>
                                <span className = 'item-page-brand'>SAMPLE-TEXT</span>
                                <h1 className = 'item-page-title' title = 'Название продукта'>{thisProduct.title}</h1>
                                {
                                    category &&
                                    <Link to = {to} title = 'Категория продукта' className = 'i-p-category-link'>{category.title}</Link>
                                }
                            </div>
                            <Price className = 'i-p-price' title = 'Цена за 1шт.' price = { thisProduct.price }/>
                            <div className = 'item-page-shipment-container'>
                                <a className = 'item-page-shipment-link' href = '#'>Доставка</a>
                                <span className = 'item-page-shipment-info'>рассчитывается отдельно</span>
                            </div>
                            <div className = 'i-p-counter-data'>
                                <span className = 'i-p-counter-info'>В корзине:</span>
                                <div className = 'item-page-counter-container'>
                                    <Counter
                                        value = {selected}
                                        onIncrement = {onIncrement}
                                        onChangeInput = {updateCount}
                                        disableDecr = {isNoneSelected}
                                        disableIncr = {capped}
                                        className = 'i-p-counter '
                                        btnClassName = 'button-counter-default'
                                        btnDisabledClassName = 'button-counter-default-disabled'
                                    />
                                    {
                                        !isNoneSelected &&
                                        <Price
                                            className = 'i-p-price-total'
                                            title = 'Сумма'
                                            price = { '= ' + String(selected * thisProduct.price)}
                                        />
                                    }
                                </div>
                                {
                                    otherProductsCount > 0 && <span className = 'i-p-counter-info'>{`+ ${otherProductsCount} других продуктов`}</span>
                                }
                                
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
                            <p className = 'item-page-description'>{thisProduct.description}</p>
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