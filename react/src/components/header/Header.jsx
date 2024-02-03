import React from 'react';
import {Link, Outlet} from 'react-router-dom'
import "./header.css"
import Tab from './Tab';

let pages = [
    {to: '/', text: 'Home'},
    {to: '/shop', text: 'Shop'},
    {to: '/about', text: 'About'},
]

const Header = () => {
    return (
        <div className = 'nav'>
            {pages.map(({to, text}) => {
                return <Tab to = {to} text = {text}/>
            })}
        </div>
    );
};

export default Header;