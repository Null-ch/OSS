import './items.css';
import Heart from '../../../components/icons/HeartIcon';
import Bag from '../../../components/icons/BagPlusIcon';
import React from 'react';
import Button from '../../../components/buttons/Button';
import {Link} from 'react-router-dom';
import { PRODUCTS } from './../../../utils/constants';
import { DOMAIN } from './../../../utils/url'

const Item = ({item, onClick, onQuickBuyClick}) => {
    console.log(item);
    return (
        <div className = 'item'>
            <div className = 'i-info' onClick = {onClick}>
                <Link to = {`${PRODUCTS}/${item.id}`}>
                    <img className = 'item-image' src = {`${DOMAIN}${item.preview_image}`}/>
                </Link>

                <div className = 'i-i-container'>
                    <span className = 'item-title'>{item.title}</span>
                    <div className = 'item-price-container'>
                        <span className = 'item-price'>{item.price}</span>
                        <span className = 'item-price-currency'>₽</span>
                    </div>
                </div>
                        
                {/* <div className = 'item-icons'>
                    <Heart title = 'В избранное' className = 'item-heart' width = '32' height = '32' fillColor = '#333333'/>
                    <Bag title = 'В корзину' className = 'item-bag' width = '36' height = '36' fillColor = '#333333'/>
                </div> */}

                <div className = 'item-preview-buttons'>
                    {/* <Button
                    className = 'item-quick-buy-button'
                    text = 'Смотреть'
                    onClick = {(e) => {
                        onQuickBuyClick(item);
                        e.stopPropagation();
                    }}
                    /> */}
                </div>
            </div>

            <div className = 'i-controls'>
                <div className = 'i-c-info'>
                    <span>{`В наличии: ${item.quantity} шт.`}</span>
                </div>
                <Button
                    className = 'i-c-button'
                    text = 'В корзину'
                />                            
            </div>
        </div>
    );
};

export default Item;