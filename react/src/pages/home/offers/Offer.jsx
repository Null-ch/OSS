import React from 'react';
import './offers.css';

const Offer = (item) => {
    // console.log(item)
    return (
        <div className = 'offer'>
            <img src = {item.item.src}>
            </img>
            <div className='offer-title-container'>
                <div className='offer-title-header-container'>
                    <span className='offer-title'>
                        ПРЕМИУМ-МЫЛО С ЭКСТРАКТОМ АВОКАДО
                    </span>
                </div>
            </div>
        </div>
    );
};

export default Offer;