import React from 'react';
import BagIcon from '../../components/icons/BagIcon';
import { useSelector } from 'react-redux';
import './cart.css';

const Cart = () => {
    const items = useSelector(state => state.cart.cart);

    // console.log(items);

    let count = 0;
    for (let id in items) {
        let product = items[id];
        if (!product) { continue; };
        count += (product.count || 0);
    }

    return (
        <div className = 'c-icon-container'>
            <BagIcon width = '44' height = '44' fillColor = '#333333'/>
            <span className = 'c-icon-counter'>{count}</span>
        </div>
    );
};

export default Cart;