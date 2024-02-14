import React from 'react';
import { Nav } from './Nav';
import LogoIcon from '../icons/LogoIcon';
import { shopName } from '../../util/constants';
import ProfileLoginButton from '../buttons/ProfileLoginButton';
import ThemeButton from '../buttons/ThemeButton';
import Button from '../buttons/Button';
import BagIcon from '../icons/BagIcon';

const Header = () => {
    return (
        <div className = 'header'>
            <LogoIcon text = { shopName } width = '88' height = '88' fillColor = '#333333'/>
            <Nav/>
            
            <div className = 'header-btns'>
                <ProfileLoginButton/>
                <Button route = '/cart' className = 'button-hover' icon = {<BagIcon width = '36' height = '36' fillColor = '#8e8e8e'/>}/>
                <ThemeButton/>
            </div>
        </div>
    );
};

export default Header;