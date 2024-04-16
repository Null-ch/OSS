import Tab from './Tab';
import "./header.css"
import { nav } from '../../routes';
import React from 'react';
import { useLocation } from 'react-router-dom';

const Nav = () => {
    const location = useLocation();
    const p = location.pathname;

    return (
        <div className = 'nav'>
            {nav.map(({path, title}, key) => {
                const r = path === '/' ? path === p : p.startsWith(path);

                return <Tab
                    className = { r ? 'tab-active' : 'tab-inactive'}
                    key = {key}
                    path = {path}
                    title = {title}/>
                })}
        </div>
    );
};

export {Nav}