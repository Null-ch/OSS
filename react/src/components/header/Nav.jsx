import Tab from './Tab';
import "./header.css"
import { nav } from '../../routes';
import { React, useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useLocation } from 'react-router-dom';
import {fetchCategories} from '../../store/categorySlice';

const Nav = () => {
    const location = useLocation();
    const p = location.pathname;

    const dispatch = useDispatch()
    const {data: categories} = useSelector((state) => state.category)
    useEffect(() => { dispatch(fetchCategories()); }, []);

    return (
        <div className = 'nav'>
            {
                nav.map(({path, title, listEntities, list}, key) => {
                    var dropdownList = null;
                    //! todo дропдаун не закрыватся в прочих кейсах, н-р в истории <- -> на странице
                    if (list && listEntities && listEntities === 'categories') {
                        var dropdownList = list.slice();

                        categories.map((cat) => {
                            dropdownList.push({
                                path: `/products/category/${cat.id}`,
                                title: cat.title,
                            })
                        });
                    }
                    return <Tab
                        className = { (path === '/' ? path === p : p.startsWith(path)) ? 'tab-active' : 'tab-inactive'}
                        key = {key}
                        path = {path}
                        title = {title}
                        list = {dropdownList}
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