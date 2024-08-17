import { React, useState, useEffect } from 'react';
import { useGetItemQuery } from '../../store/query/itemsApi';
import './itemPage.css'
import Counter from '../../components/counter/Counter';
import Button from '../../components/buttons/Button';
import { useParams, Link } from 'react-router-dom'
import Price from '../../components/util/Price';
import { updateCartProducts, updateCartTry } from '../../store/cartSlice';
import { useSelector, useDispatch } from 'react-redux';
import debounce from './../../lib/utils'
import { updateTabTitle } from '../../lib/tab';
import { getCategory } from '../../lib/category';
import { path } from '../../lib/path';

// window.localStorage.clear();

const ItemPage = () => {
    console.log('ItemPage')
    const { id } = useParams();
    const dispatch = useDispatch();
    const categories = useSelector(state => state.category.data);
    const cart_products = useSelector(state => state.cart.cart);
    const { data = {}, isLoading } = useGetItemQuery(id);

    let currentProduct = useSelector(state => state.cart.currentProduct) || {};
    if (currentProduct && currentProduct.id != id) {
        currentProduct = data.data || {}
    }

    const { price, description, quantity: left, title, preview_image } = currentProduct;

    updateTabTitle(title);

    let category = getCategory(categories, currentProduct?.category_id);

    let otherProductsCount = 0;
    let selected = 0;

    for (let key in cart_products) {
        const cart_product = cart_products[key];
        const product = cart_product.product;
        if (product.id == id) continue;
        otherProductsCount += cart_product.count;
    }

    if (cart_products && currentProduct) {
        let p = cart_products[id] || {};
        selected = p.count || selected;
    }

    const total = (left || 0) + selected;
    const isNoneSelected = selected < 1;
    const capped = left < 1;

    function updateCount(count) {
        dispatch(updateCartProducts({ count, product: currentProduct })) // visual
        debounce(() => {
            dispatch(updateCartTry({ id, quantity: count })); // request
        }, 500, 'updateCartTry');
    }

    // todo test
    if (selected > total) {
        updateCount(total);
    }

    function onIncrement(incr) {
        updateCount(Math.max(0, Math.min(Number(selected) + incr, total)));
    }

    return (
        <div>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
            {currentProduct &&
                <article className = 'item-page'>
                    <div className = 'i-p-preview-container'> 
                        <img className = 'i-p-preview' src = { path(preview_image) }/>
                    </div>
                
                    <div className = 'i-p-info-container'>
                        <div className = 'i-p-info'>
                            <div className = 'item-page-title-container'>
                                <span className = 'item-page-brand'>SAMPLE-TEXT</span>
                                <h1 className = 'item-page-title' title = 'Название продукта'>{title}</h1>
                                {
                                    category &&
                                    <Link to = { category && '/products/category/' + category.id } title = 'Категория продукта' className = 'i-p-category-link'>{ category.title }</Link>
                                }
                            </div>
                            <Price className = 'i-p-price' title = 'Цена за 1шт.' price = { price }/>
                            <div className = 'item-page-shipment-container'>
                                <a className = 'item-page-shipment-link' href = '#'>Доставка</a>
                                <span className = 'item-page-shipment-info'>рассчитывается отдельно</span>
                            </div>
                            <div className = 'i-p-counter-data'>
                                <span className = 'i-p-counter-info'>В корзине:</span>
                                <div className = 'item-page-counter-container'>
                                    <Counter
                                        value = { selected }
                                        onIncrement = { onIncrement }
                                        onChangeInput = { updateCount }
                                        disableDecr = { isNoneSelected }
                                        disableIncr = { capped }
                                        className = 'i-p-counter '
                                        btnClassName = 'button-counter-default'
                                        btnDisabledClassName = 'button-counter-default-disabled'
                                    />
                                    <div>
                                        {
                                            !isNoneSelected &&
                                            <Price
                                                className = 'i-p-price-total'
                                                title = 'Сумма'
                                                price = { '= ' + String(selected * price)}
                                            />
                                        }
                                        {
                                            otherProductsCount > 0 && <span className = 'i-p-counter-info'>{`+ ${otherProductsCount} других продуктов`}</span>
                                        }
                                    </div>
                                </div>
                                <span className = 'i-p-counter-info'>{`осталось ${left} шт.`}</span>
                                
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
                            <p className = 'item-page-description'>{description}</p>
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