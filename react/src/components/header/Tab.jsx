<<<<<<< HEAD
import React from 'react';
import {Link} from 'react-router-dom'
=======
import React, { useState } from 'react';
import {Link, Outlet} from 'react-router-dom'
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
import "./header.css"
import ArrowIcon from '../../components/icons/ArrowIcon';
import DropdownMenu from '../dropdown/DropdownMenu';

<<<<<<< HEAD
const Tab = ({path, title, list, onClick, className}) => {
    console.log(list)
    return (
        <Link
        className = {className} to = {path} onClick = { list ? (e) => {
        } : onClick}>
            <div className = 'tab-title'>
                <span>{title}</span>
                {
                    list && <ArrowIcon
                        className = 'arrow-hover'
                        rotate = '0'
                        width = '24'
                        height = '24'
                        fillColor = '#f7f7f7'
                    />
                }
            </div>
            {
                list && <DropdownMenu list = {list}/>
            }
=======

const Tab = ({path, title, onClick, className}) => {
    return (
        <Link onClick = {onClick} className={className} to = {path}>
            <span>
                {title}
            </span>
>>>>>>> 0e8f35afd20cf5efe9539ae6d58590be45c12c40
        </Link>
    );
};

export default Tab;