import React from 'react';
import { Nav } from './Nav';
import logo from './../../icons/logo.svg'
import './header.less'
import Logo from '../Logo';
import { shopName } from '../../util/constants';
import Button from '../Button';

const Header = () => {
    return (
        <div className = 'header'>
            <Logo className = 'header-logo' src = { logo } title = {shopName}/>
            <Nav/>
            
            <Button text = 'LOGIN' route = '/login'/>
            <Button text = 'LOGOUT' route = '/logout'/>
            todo search, cart, theme
        </div>
    );
};

export default Header;