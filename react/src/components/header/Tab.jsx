import React from 'react';
import {Link, Outlet} from 'react-router-dom'
import "./header.css"

const Tab = ({path, title}) => {
    return (
        <Link className='tab' to = {path}>
            <span>
                {title}
            </span>
        </Link>
    );
};

export default Tab;