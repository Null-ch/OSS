import './items.css';
import Heart from '../../../components/icons/HeartIcon';
import Bag from '../../../components/icons/BagPlusIcon';
import React from 'react';
import Button from '../../../components/buttons/Button';
import {Link} from 'react-router-dom';
import { PRODUCTS } from './../../../utils/constants';
<<<<<<< HEAD
import { DOMAIN } from './../../../utils/url'
=======
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40

const Item = ({item, onClick, onQuickBuyClick}) => {
    return (
            <div className = 'item' onClick = {onClick}>
                <Link to = {`${PRODUCTS}${item.id}`}>
<<<<<<< HEAD
                    <img className = 'item-image' src = {`${DOMAIN}${item.preview_image}`}/>
=======
                    <img className = 'item-image' src = {item.images[1]}/>
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40

                    <div className = 'item-info-container'>
                        <span className = 'item-title'>{item.title}</span>
                        <div className = 'item-price-container'>
                            <span className = 'item-price'>{item.price}</span>
                            <span className = 'item-price-currency'>₽</span>
                        </div>
                    </div>
                </Link>
        
                <div className = 'item-icons'>
                    <Heart title = 'В избранное' className = 'item-heart' width = '32' height = '32' fillColor = '#333333'/>
                    <Bag title = 'В корзину' className = 'item-bag' width = '36' height = '36' fillColor = '#333333'/>
                </div>

                <div className = 'item-preview-buttons'>
                    <Button
                    className = 'item-quick-buy-button'
                    text = 'Смотреть'
                    onClick = {(e) => {
                        onQuickBuyClick(item);
                        e.stopPropagation();
                    }}
                    />
                </div>
            </div>
    );
};

export default Item;