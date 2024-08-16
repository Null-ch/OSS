import React from 'react';

const Modal = ({ isActive, onBackgroundClick, content }) => {
    return (
        <>
            {
                isActive && (
                <div className = 'modal-default' onClick = { onBackgroundClick }>
                    { content }
                </div>)
            }
        </>

    );
};

export default Modal;