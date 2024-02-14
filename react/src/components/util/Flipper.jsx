import React from 'react';
import './flipper.css';


const Flipper = ({icon, variant}) => {
    const className = variant==='left' ? 'flipper-left' : 'flipper-right'
    console.log(className)
    return (
        <div className = {className} style={{width: 50}}>
            {icon}
        </div>
    );
};

export default Flipper;