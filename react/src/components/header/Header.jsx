import React, { useState } from 'react';
import { Nav } from './Nav';
import LogoIcon from '../icons/LogoIcon';
import { shopName } from '../../utils/constants';
// import ProfileLoginButton from '../buttons/ProfileLoginButton';
// import ThemeButton from '../buttons/ThemeButton';
import Button from '../buttons/Button';
import BagIcon from '../icons/BagIcon';
import Bubble from '../bubble/Bubble';
import CartPreview from '../../pages/cart/CartPreview';

import './header.css'

const Header = () => {

    const [isBubbleHidden, hideBubble] = useState(true);

    function onCartClick() {
        hideBubble(!isBubbleHidden);
    }

    function onClose() {
        hideBubble(true);
    }

    return (
        <div id = 'header' className = 'header'>
            <LogoIcon text = { shopName } width = '64' height = '64' fillColor = '#333333'/>
            <Nav/>
            
            <div className = 'header-btns'>
                {/* <ProfileLoginButton/> */}
                <Button
                    onClick = {onCartClick}
                    bubble = {
                        <Bubble
                            hidden = {isBubbleHidden}
                            content = {<CartPreview onClose = {onClose}/>}
                        />
                    }
                    // route = '/cart'
                    className = 'h-cart-button'
                    icon = {<BagIcon width = '44' height = '44' fillColor = '#333333'/>}
                />
                {/* <ThemeButton/> */}
            </div>
        </div>
    );
};

export default Header;