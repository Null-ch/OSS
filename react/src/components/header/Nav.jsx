import Tab from './Tab';
import "./header.css"
import { nav } from '../../routes';
import {React} from 'react';
import { useLocation } from 'react-router-dom';

const Nav = () => {
    const location = useLocation();
    const p = location.pathname;

    return (
        <div className = 'nav'>
            {
                nav.map(({path, title, list, listEntities}, key) => {
                    return <Tab
                        className = { (path === '/' ? path === p : p.startsWith(path)) ? 'tab-active' : 'tab-inactive'}
                        key = {key}
                        path = {path}
                        title = {title}
                        list = {list}
                        listEntities = {listEntities}
                        // dropdownButtonRef = {dropdownButtonRef}
                        // dropdownMenuRef = {dropdownMenuRef}
                        // isOpened = {isOpened}
                        // setIsOpened = {setIsOpened}
                    />
                })
            }
        </div>
    );
};

export {Nav}