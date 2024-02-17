import Tab from './Tab';
import "./header.css"
import { nav } from '../../routes';
import React, { useState } from 'react';
import { useLocation } from 'react-router-dom';

let pages = [
    {to: '/', text: 'Home'},
    {to: '/shop', text: 'Shop'},
    {to: '/about', text: 'About'},
]

const Nav = () => {
    
    // const [toggleState, setToggleState] = useState(1);
    // const toggleTab = (index) => {
    //     setToggleState(index);
    // }

    const location = useLocation();
    // console.log(location.pathname);

    return (
        <div className = 'nav'>
            {nav.map(({path, title}, key) => {
                return <Tab
                className = {path===location.pathname ? 'tab-active' : 'tab-inactive'}
                // onClick = {() => toggleTab(key)}
                key = {key}
                path = {path}
                title = {title}/>
            })}
        </div>
    );
};

export {Nav}