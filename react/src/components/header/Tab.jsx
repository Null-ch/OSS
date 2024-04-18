import React from 'react';
import {Link} from 'react-router-dom'
import "./header.css"
import ArrowIcon from '../../components/icons/ArrowIcon';
import DropdownMenu from '../dropdown/DropdownMenu';

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
        </Link>
    );
};

export default Tab;