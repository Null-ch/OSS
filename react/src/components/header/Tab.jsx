import React, { useState } from 'react';
import {Link, Outlet} from 'react-router-dom'
import "./header.css"


const Tab = ({path, title, onClick, className}) => {
    return (
        <Link onClick = {onClick} className={className} to = {path}>
            <span>
                {title}
            </span>
        </Link>
    );
};

export default Tab;