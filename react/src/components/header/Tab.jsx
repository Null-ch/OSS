import React from 'react';
import {Link, Outlet} from 'react-router-dom'
import "./header.css"

const Tab = ({to, text}) => {
    return (
        <Link className='tab' to = {to}>
            <span>
                {text}
            </span>
        </Link>
    );
};

export default Tab;