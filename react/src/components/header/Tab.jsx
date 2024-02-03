import React from 'react';
import {Link, Outlet} from 'react-router-dom'
import "./header.css"

const Tab = ({to, text}) => {
    return (
        <div className = 'tab'>
            <Link className='' to = {to}>{text}</Link>
        </div>
    );
};

export default Tab;