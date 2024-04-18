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
<<<<<<< HEAD
            {
                nav.map(({path, title, list}, key) => {

                    return <Tab
                        className = { (path === '/' ? path === p : p.startsWith(path)) ? 'tab-active' : 'tab-inactive'}
                        key = {key}
                        path = {path}
                        title = {title}
                        list = {list}
                    />
                })
            }
=======
            {nav.map(({path, title}, key) => {
                const r = path === '/' ? path === p : p.startsWith(path);

                return <Tab
                    className = { r ? 'tab-active' : 'tab-inactive'}
                    key = {key}
                    path = {path}
                    title = {title}/>
                })}
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
        </div>
    );
};

export {Nav}