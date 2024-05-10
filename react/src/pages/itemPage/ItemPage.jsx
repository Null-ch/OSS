import {React, useState} from 'react';
import { useGetItemQuery } from '../../store/query/itemsApi';
import './itemPage.css'
import {DOMAIN} from '../../utils/url'
import Counter from '../../components/counter/Counter';
import Button from '../../components/buttons/Button';
// import NotFound from '../util/NotFound';
import {useParams} from 'react-router-dom'

const ItemPage = () => {
    // общее хранилище со всеми продуктами, либо сбор всех и кеширование
    const { id } = useParams(); // Object с полями перечисленными в этом эндпоинте

    const {data = [], isLoading} = useGetItemQuery(id);

    // console.log(data);

    const product = data.product

    var cart = JSON.parse(window.localStorage.getItem('oss-cart')) || {};

    const [count, setCount] = useState(cart[id] || 0);

    function updateCount(value) {
        cart[id] = value;
        window.localStorage.setItem('oss-cart', JSON.stringify(cart));
        setCount(value);
    }

    function onChangeCounter(e) {
        updateCount(e.target?.value);
    }

    function onIncrement(incr) {
        var value = Math.max(0, Math.min(Number(count) + incr));
        updateCount(value);
    }

    const isNoneSelected = count < 1;

    return (
        <div>
            {/* {isLoading ? <h1>Loading...</h1> : ''} */}
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
                            <span className = 'item-page-price-currency'>₽</span>
                        </div>
                        <div className = 'item-page-shipment-container'>
                            <a className = 'item-page-shipment-link' href = '#'>Доставка</a>
                            <span className = 'item-page-shipment-info'>рассчитывается отдельно</span>
                        </div>
                        <div className = 'item-page-counter-container'>
                            <Counter
                                value = {count}
                                onIncrement = {onIncrement}
                                onChangeInput = {onChangeCounter}
                                disableDecr = {isNoneSelected}
                            />
                            {
                                !isNoneSelected &&
                                <div>
                                    <span className = 'item-page-price-total' title = 'Сумма'>= {count * product.price}</span>
                                    <span className = 'item-page-price-currency-total'>₽</span>
                                </div>    
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