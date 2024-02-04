import React from 'react';
import { Nav } from './Nav';
import logo from './../../icons/logo.svg'
import './header.less'
import Logo from '../Logo';

const Header = () => {
    return (
        <div className = 'header'>
            <Logo src = { logo } title = 'PrettyShopName' className = 'header-logo'/>
            <Nav/>
        </div>
    );
};

export default Header;