import React from 'react';
import Offer from './Offer';
import './offers.css';

import Flipper from '../../../components/util/Flipper';
import ArrowIcon from '../../../components/icons/ArrowIcon';

const Offers = ({items}) => {
    const iconLeft = <ArrowIcon className = 'arrow-hover' rotate = '90' width = '36' height = '36' fillColor = '#f7f7f7'/>
    const iconRight = <ArrowIcon className = 'arrow-hover' rotate = '270' width = '36' height = '36' fillColor = '#f7f7f7'/>
    
    return (
        <div className='offers'>
            <div className='offers-list'>
                <Flipper icon = {iconLeft} variant = 'left'/>
                {items.map((item, key) => {
                    return <Offer key = {key} item = {item}/>
                })}
                <Flipper icon = {iconRight} variant = 'right'/>
            </div>
        </div>
    );
};

export default Offers;