import React, { useState } from 'react';
import { Nav } from './Nav';
import LogoIcon from '../icons/LogoIcon';
import { shopName } from '../../utils/constants';
// import ProfileLoginButton from '../buttons/ProfileLoginButton';
// import ThemeButton from '../buttons/ThemeButton';
import Button from '../buttons/Button';
// import BagIcon from '../icons/BagIcon';
import Bubble from '../bubble/Bubble';
import CartPreview from '../../pages/cart/CartPreview';
import Cart from '../../pages/cart/Cart';
import './header.css'
import {Link} from 'react-router-dom'
import { useDispatch, useSelector } from 'react-redux';
import { setCartHidden } from './../../store/cartSlice';

const Header = () => {
    const isCartHidden = useSelector((state) => state.cart.isCartHidden);

    const dispatch = useDispatch();
    const hideCart = (v) => dispatch(setCartHidden(v));

    function onCartClick() { hideCart(!isCartHidden) };
    function onClose() { hideCart(true) };

    return (
        <div id = 'header' className = 'header'>
            <div className = 'h-section-left'>
                <Link className = 'brand' to = '/'>SAMPLE TEXT</Link>
            </div>
            
            <div className = 'h-section-nav'>
                <Nav/>
            </div>

            <div className = 'h-section-right'>
                <div className = 'header-btns'>
                    {/* <ProfileLoginButton/> */}
                    <Button
                        onClick = {onCartClick}
                        bubble = {
                            <Bubble
                                hidden = {isCartHidden}
                                content = {<CartPreview onClose = {onClose}/>}
                            />
                        }
                        // route = '/cart'
                        className = 'h-cart-button'
                        icon = {<Cart/>}
                    />
                    {/* <ThemeButton/> */}
                </div>  
            </div>

            {/* <LogoIcon text = { shopName } width = '64' height = '64' fillColor = '#333333'/> */}
        </div>
    );
};

export default Header;