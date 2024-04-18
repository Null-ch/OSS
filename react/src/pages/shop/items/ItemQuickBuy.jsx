import React from 'react';
import './itemQuickBuy.css';
import { useSelector } from 'react-redux';
import Button from '../../../components/buttons/Button';
import { Link } from 'react-router-dom';
<<<<<<< HEAD
import { DOMAIN } from './../../../utils/url'
=======
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40

// todo price в отдельный компонент

const ItemQuickBuy = () => {
    const {data: item} = useSelector((state) => state.modal);
    // console.log(item);

    const onClick = (e) => {
        e.stopPropagation();
    }

    return (
        <div className = 'quick-buy-window' onClick = {onClick}>
            <div className = 'quick-buy-header'>
                <span className = 'quick-buy-item-title'>
                    {item.title}
                </span>
            </div>
        
            <div className = 'quick-buy-body'>
                <div className = 'quick-buy-image-container'>
<<<<<<< HEAD
                    <img className = 'quick-buy-image' src = {`${DOMAIN}${item.preview_image}`} />
=======
                    <img className = 'quick-buy-image' src = {item.images[1]} />
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
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

                    <Link to = {`products/${item.id}`}>
                        <a className = 'span-link'>Страница товара</a>
                    </Link>
                </div>
                <Button text = 'Купить'/>
            </div>
        </div>
    );
};

export default ItemQuickBuy;