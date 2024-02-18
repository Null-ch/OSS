import React from 'react';
import './offers.css';

const Offer = (item) => {
    // console.log(item)
    return (
        <div className = 'offer'>
            <img src = {item.item.src}>
            </img>
            <div className='offer-descr-container'>
                <div className='offer-descr-header-container'>
                    <span className='offer-descr'>
                        ПРЕМИУМ-МЫЛО С ЭКСТРАКТОМ АВОКАДО И ГОВНА
                    </span>
                </div>
            </div>
        </div>
    );
};

export default Offer;