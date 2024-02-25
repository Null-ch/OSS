import React from 'react';
import './itemQuickBuy.css';
import { useSelector } from 'react-redux';
import Button from '../../../components/buttons/Button';

// todo price в отдельный компонент

const ItemQuickBuy = () => {
    const {data: item} = useSelector((state) => state.modal);
    console.log(item);

    return (
        <div className = 'quick-buy-window'>
            <div className = 'quick-buy-header'>
                <span className = 'quick-buy-item-title'>
                    {item.title}
                </span>
            </div>
        
            <div className = 'quick-buy-body'>
                <div className = 'quick-buy-image-container'>
                    <img className = 'quick-buy-image' src = {item.images[1]} />
                </div>
                <div className = 'quick-buy-item-descr'>
                    <span>
                        {item.description}
                    </span>
                </div>
            </div>

            <div className = 'quick-buy-footer'>
                <div className = 'quick-buy-item-price-container'>
                    <div>
                        <span className = 'item-price'>{item.price}</span>
                        <span className = 'item-price-currency'>₽</span>
                    </div>
                    <a className = 'span-link'>Страница товара</a>
                </div>
                <Button text = 'Купить'/>
            </div>
        </div>
    );
};

export default ItemQuickBuy;