import React from 'react';

const Logo = ({src, className, title}) => {
    return (
        <div className = {className}>
            <img src = {src}/>
            <span>{title}</span>
        </div>
    );
};

export default Logo;