import React from 'react';
import { Nav } from './Nav';
import logo from './../../icons/logo.svg'
import './header.less'
import Logo from '../Logo';
import { shopName } from '../../util/constants';

const Header = () => {
    return (
        <div className = 'header'>
            <Logo className = 'header-logo' src = { logo } title = {shopName}/>
            <Nav/>
            todo search, login, cart, theme
        </div>
    );
};

export default Header;