import React from 'react';
import './bubble.css'

const Bubble = ({content, hidden}) => {
    if (hidden) {
        return;
    }
    return (
        <div className = { hidden ? 'bubble-hidden' : 'bubble' }>
            {content}
        </div>
    );
};

export default Bubble;